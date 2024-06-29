<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bapendik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Model_Mahasiswa');
        $this->load->model('Model_User');
        $this->load->model('Model_Sertifikat');
        $this->load->model('Model_Verifikasi');

        //check_admin();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jumlah_mhs'] = $this->Model_User->get_jumlah_mahasiswa();
        $data['jumlah_permo'] = $this->Model_User->get_jumlah_permohonan();
        $data['jumlah_permosetuju'] = $this->Model_User->get_jumlah_permohonansetuju();
        $data['jumlah_permotolak'] = $this->Model_User->get_jumlah_permohonantolak();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/index', $data);
        $this->load->view('templates/footer');
    }

    public function profil()
    {
        $data['title'] = 'My Profil';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Model_User');
        // Get the user's detailed profile including agama and goldar
        $user_id = $data['user']['id'];
        $data['user'] = $this->Model_User->get_bapendik($user_id);

        // Mendapatkan data agama dan golongan darah dari tabel terkait
        $data['agama'] = $this->db->get('tb_agama')->result_array();
        $data['goldar'] = $this->db->get('tb_goldar')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/profil', $data);
        $this->load->view('templates/footer');
    }

    public function registrasi()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'is_unique' => 'Email ini sudah terdaftar'
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');
        $this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[8]|callback_valid_password|matches[pass2]', [
            'matches' => 'Password is not the same!',
            'min_length' => 'The password is too short!'
        ]);
        $this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Registrasi Bapendik';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('bapendik/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', TRUE)),
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'nip' => htmlspecialchars($this->input->post('nip', TRUE)),
                'image' => 'admin.jpg',
                'pass' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'agama_id' => 8,
                'goldar_id' => 5,
                'role_id' => 2,
                'is_active' => 1,
                'tgl_dibuat' => time(),
            ];

            $this->db->insert('tb_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat!</div>');
            redirect('bapendik');
        }
    }

    public function updatepassword()
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required|trim', [
            'required' => 'Password Baru harus diisi'
        ]);
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|trim|min_length[8]|callback_valid_password2|matches[confirm_password]', [
            'required' => 'Password Baru harus diisi',
            'matches' => 'Password tidak sesuai',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|trim|matches[new_password]', [
            'required' => 'Konfirmasi Password harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->profil();
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            // Memeriksa apakah password saat ini sesuai
            if (!password_verify($current_password, $data['user']['pass'])) {
                $this->session->set_flashdata('message', 'Password Salah');
            } else {
                // Memeriksa apakah password baru sama dengan password lama
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', 'Password Baru tidak boleh sama dengan password lama');
                } else {
                    // Hash password baru
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    // Simpan password baru ke dalam basis data
                    $this->db->set('pass', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tb_user');

                    $this->session->set_flashdata('message', 'Password Berhasil Diubah');
                }
            }

            // Setelah proses selesai, redirect ke halaman profil
            redirect('bapendik/profil');
        }
    }

    public function valid_password($password)
    {
        $password = trim($password);
        $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/';

        if (preg_match($regex, $password)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_password', 'The password must be at least 8 characters long, containing at least one capital letter, one lowercase letter, one number, and one symbol.');
            return FALSE;
        }
    }

    public function valid_password2($password)
    {
        $password = trim($password);
        $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/';

        if (preg_match($regex, $password)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_password2', 'Password harus terdiri dari minimal 8 karakter, berisi minimal satu huruf kapital, satu huruf kecil, satu angka, dan satu simbol.');
            return FALSE;
        }
    }


    public function updatebiodata()
    {
        // Dapatkan data user
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $user_id = $data['user']['id'];
        $data['user'] = $this->Model_User->get_bapendik($user_id);

        // Validasi form
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'valid_email' => 'Format email tidak benar'
        ]);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin');
        $this->form_validation->set_rules('telp', 'No Telp');
        $this->form_validation->set_rules('alamat', 'Alamat');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir');
        $this->form_validation->set_rules('agama', 'Agama');
        $this->form_validation->set_rules('goldar', 'Golongan Darah');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Update Biodata';
            $data['agama_list'] = $this->db->get('tb_agama')->result_array();
            $data['goldar_list'] = $this->db->get('tb_goldar')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/updatebiodata', $data);
            $this->load->view('templates/footer');
        } else {
            // Upload gambar
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['file_name'] = 'profile_' . $user_id;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];

                    // Hapus gambar lama jika bukan default
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        if (file_exists(FCPATH . 'assets/img/profile/' . $old_image)) {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('bapendik/profil');
                    return;
                }
            } else {
                $image = $data['user']['image'];
            }

            // Data yang akan diupdate
            $updateData = [
                'agama_id' => $this->input->post('agama'),
                'goldar_id' => $this->input->post('goldar'),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', TRUE)),
                'gender' => $this->input->post('gender'),
                'telp' => htmlspecialchars($this->input->post('telp', TRUE)),
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'alamat' => htmlspecialchars($this->input->post('alamat', TRUE)),
                'image' => $image
            ];

            // Update biodata
            $this->Model_User->update_biodata($user_id, $updateData);

            $this->session->set_flashdata('message', 'Biodata updated successfully!');
            redirect('bapendik/profil');
        }
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Model_Laporan');
        $data['laporan'] = $this->Model_Laporan->get_laporan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function mahasiswa()
    {
        $data['title'] = 'Mahasiswa';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['mahasiswa'] = $this->Model_Mahasiswa->getMhs();
        $data['users'] = $this->db->get_where('tb_user', ['role_id' => 1])->result_array();
        $data['prodi'] = $this->db->get('tb_prodi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function verifikasi()
    {
        $data['title'] = 'Verifikasi';
        // $this->db->order_by('id', 'DESC');
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        //  $data['verifikasi'] = $this->db->get_where('tb_permo', ['persetujuan' => 0])->result_array();

        $data['verifikasi'] = $this->Model_Verifikasi->getVerif();
        // $data['bidang'] = $this->db->get('tb_sertif_bidang')->result_array();
        // $data['kategori'] = $this->db->get('tb_sertif_kategori')->result_array();
        // $data['capaian'] = $this->db->get('tb_sertif_capaian')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/verifikasi', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_verif()
    {
        $persetujuan_list = $this->input->post('persetujuan');
        $ids = $this->input->post('id');
        $nim_mhs_list = $this->input->post('nim_mhs');
        $bidang_id_list = $this->input->post('bidang_id');
        $kategori_id_list = $this->input->post('kategori_id');
        $capaian_id_list = $this->input->post('capaian_id');

        foreach ($ids as $id) {
            $persetujuan = isset($persetujuan_list[$id]) ? $persetujuan_list[$id] : null;
            $nim_mhs = isset($nim_mhs_list[$id]) ? $nim_mhs_list[$id] : null;
            $bidang_id = isset($bidang_id_list[$id]) ? $bidang_id_list[$id] : null;
            $kategori_id = isset($kategori_id_list[$id]) ? $kategori_id_list[$id] : null;
            $capaian_id = isset($capaian_id_list[$id]) ? $capaian_id_list[$id] : null;

            if ($persetujuan !== null && $nim_mhs !== null) {
                $data = [
                    'persetujuan' => $persetujuan
                ];

                // Update the persetujuan field in tb_permo
                $this->db->where('id', $id);
                $this->db->update('tb_permo', $data);

                if ($persetujuan == 1 && $bidang_id !== null && $kategori_id !== null && $capaian_id !== null) {
                    // Fetch the points from tb_sertif
                    $this->db->select('skor');
                    $this->db->from('tb_sertif');
                    $this->db->where('bidang_id', $bidang_id);
                    $this->db->where('kategori_id', $kategori_id);
                    $this->db->where('capaian_id', $capaian_id);
                    $sertif = $this->db->get()->row_array();

                    if ($sertif) {
                        $points = $sertif['skor'];

                        // Fetch the current point from tb_mhs
                        $this->db->select('point');
                        $this->db->from('tb_mhs');
                        $this->db->where('nim_mhs', $nim_mhs);
                        $mhs = $this->db->get()->row_array();

                        if ($mhs) {
                            $current_points = $mhs['point'];
                            $new_points = $current_points + $points;

                            // Update the points in tb_mhs
                            $this->db->set('point', $new_points);
                            $this->db->where('nim_mhs', $nim_mhs);
                            $this->db->update('tb_mhs');
                        } else {
                            // Handle case where the student is not found in tb_mhs
                            // Optional: Insert the student with the new points if not found
                            $new_points = $points;

                            $this->db->insert('tb_mhs', [
                                'nim_mhs' => $nim_mhs,
                                'point' => $new_points
                            ]);
                        }
                    }
                    redirect('bapendik/verif_setuju');
                }
                redirect('bapendik/verif_tolak');
            }
        }

        // Set flashdata for notification
        $this->session->set_flashdata('success', 'Persetujuan berhasil disimpan.');

        // Redirect based on the value of persetujuan
        if ($persetujuan == 1) {
            redirect('bapendik/verif_setuju');
        } elseif ($persetujuan == 2) {
            redirect('bapendik/verif_tolak');
        } else {
            redirect('bapendik/verifikasi');
        }
    }


    public function verif_setuju()
    {
        $data['title'] = 'Verifikasi Disetujui';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['verifikasi'] = $this->Model_Verifikasi->getVerifikasi();
        // $data['bidang'] = $this->db->get('tb_sertif_bidang')->result_array();
        // $data['kategori'] = $this->db->get('tb_sertif_kategori')->result_array();
        // $data['capaian'] = $this->db->get('tb_sertif_capaian')->result_array();
        // $this->db->order_by('id', 'DESC');
        // $data['verifikasi'] = $this->db->get_where('tb_permo', ['persetujuan' => 1])->result_array();

        $data['verifikasi'] = $this->Model_Verifikasi->getVerifSetuju();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/verif_setuju', $data);
        $this->load->view('templates/footer');
    }

    public function verif_tolak()
    {
        $data['title'] = 'Verifikasi Ditolak';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['verifikasi'] = $this->Model_Verifikasi->getVerifikasi();
        // $data['bidang'] = $this->db->get('tb_sertif_bidang')->result_array();
        // $data['kategori'] = $this->db->get('tb_sertif_kategori')->result_array();
        // $data['capaian'] = $this->db->get('tb_sertif_capaian')->result_array();
        // $this->db->order_by('id', 'DESC');
        // $data['verifikasi'] = $this->db->get_where('tb_permo', ['persetujuan' => 2])->result_array();

        $data['verifikasi'] = $this->Model_Verifikasi->getVerifTolak();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/verif_tolak', $data);
        $this->load->view('templates/footer');
    }


    public function sertifikat()
    {
        $data['title'] = 'Sertifikat';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['sertifikat'] = $this->Model_Sertifikat->getSertif();
        $data['bidang'] = $this->db->get('tb_sertif_bidang')->result_array();
        $data['kategori'] = $this->db->get('tb_sertif_kategori')->result_array();
        $data['capaian'] = $this->db->get('tb_sertif_capaian')->result_array();

        $this->form_validation->set_rules('bidang_id', 'Bidang', 'required', array('required' => 'Bidang harus diisi.'));
        $this->form_validation->set_rules('capaian_id', 'Capaian', 'required', array('required' => 'Capaian harus diisi.'));
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required', array('required' => 'Kategori harus diisi.'));
        $this->form_validation->set_rules('skor', 'Skor', 'required', array('required' => 'Skor harus diisi.'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/sertifikat', $data);
            $this->load->view('templates/footer');
        } else {
            $sertif_data = [
                'bidang_id' => $this->input->post('bidang_id'),
                'capaian_id' => $this->input->post('capaian_id'),
                'kategori_id' => $this->input->post('kategori_id'),
                'skor' => $this->input->post('skor')
            ];
            $this->db->insert('tb_sertif', $sertif_data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data sertifikat berhasil ditambahkan!</div>');
            redirect('bapendik/sertifikat');
        }
    }

    public function edit_sertif($id)
    {
        $bidang_id = $this->input->post('bidang_id');
        $capaian_id = $this->input->post('capaian_id');
        $kategori_id = $this->input->post('kategori_id');
        $skor = $this->input->post('skor');

        if ($bidang_id && $capaian_id && $kategori_id && $skor) {
            $data = [
                'bidang_id' => $bidang_id,
                'capaian_id' => $capaian_id,
                'kategori_id' => $kategori_id,
                'skor' => $skor
            ];
            $this->db->where('id', $id);
            $this->db->update('tb_sertif', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Sertifikat berhasil diupdate!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Semua field harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function delete_sertifikat($id)
    {
        // Check if the ID exists in the database
        $bidang = $this->db->get_where('tb_sertif', ['id' => $id])->row_array();

        if ($bidang) {
            $this->db->where('id', $id);
            $this->db->delete('tb_sertif');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Sertifikat berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Sertifikat tidak ditemukan atau sudah dihapus.</div>');
        }

        redirect('bapendik/sertifikat');
    }

    public function tambah_bidang()
    {
        $nama_bidang = $this->input->post('nama_bidang');
        if ($nama_bidang) {
            $this->db->insert('tb_sertif_bidang', ['bidang' => $nama_bidang]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bidang berhasil ditambahkan!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama bidang harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function edit_bidang($id)
    {
        $bidang = $this->input->post('bidang');
        if ($bidang) {
            $this->db->where('id', $id);
            $this->db->update('tb_sertif_bidang', ['bidang' => $bidang]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bidang berhasil diupdate!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama bidang harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function update_bidang()
    {
        // Get the data from the form
        $id = $this->input->post('id');
        $bidang = $this->input->post('bidang');

        // Prepare the data to be updated
        $data = [
            'bidang' => $bidang
        ];

        // Call the model function to update the data
        $result = $this->Model_Sertifikat->updateBidang($id, $data);

        // Check if the update was successful
        if ($result) {
            // Set a success message
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bidang berhasil diupdate!</div>');
        } else {
            // Set an error message
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Bidang gagal diupdate!</div>');
        }

        // Redirect to the bidang page
        redirect('bapendik/sertifikat');
    }

    public function delete_bidang($id)
    {
        // Check if the ID exists in the database
        $bidang = $this->db->get_where('tb_sertif_bidang', ['id' => $id])->row_array();

        if ($bidang) {
            $this->db->where('id', $id);
            $this->db->delete('tb_sertif_bidang');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bidang berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Bidang tidak ditemukan atau sudah dihapus.</div>');
        }

        redirect('bapendik/sertifikat');
    }


    public function tambah_capaian()
    {
        $nama_capaian = $this->input->post('nama_capaian');
        if ($nama_capaian) {
            $this->db->insert('tb_sertif_capaian', ['capaian' => $nama_capaian]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Capaian berhasil ditambahkan!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama capaian harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function edit_capaian($id)
    {
        $capaian = $this->input->post('nama_capaian');
        if ($capaian) {
            $this->db->where('id', $id);
            $this->db->update('tb_sertif_capaian', ['capaian' => $capaian]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Capaian berhasil diupdate!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama capaian harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function delete_capaian($id)
    {
        // Check if the ID exists in the database
        $bidang = $this->db->get_where('tb_sertif_capaian', ['id' => $id])->row_array();

        if ($bidang) {
            $this->db->where('id', $id);
            $this->db->delete('tb_sertif_capaian');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Capaian berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">capaian tidak ditemukan atau sudah dihapus.</div>');
        }

        redirect('bapendik/sertifikat');
    }

    public function tambah_kategori()
    {
        $nama_kategori = $this->input->post('nama_kategori');
        if ($nama_kategori) {
            $this->db->insert('tb_sertif_kategori', ['kategori' => $nama_kategori]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil ditambahkan!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama kategori harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function edit_kategori($id)
    {
        $kategori = $this->input->post('kategori');
        if ($kategori) {
            $this->db->where('id', $id);
            $this->db->update('tb_sertif_kategori', ['kategori' => $kategori]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil diupdate!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama kategori harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function update_kategori()
    {
        // Get the data from the form
        $id = $this->input->post('id');
        $kategori = $this->input->post('kategori');

        // Prepare the data to be updated
        $data = [
            'kategori' => $kategori
        ];

        // Call the model function to update the data
        $result = $this->Model_Sertifikat->updateKategori($id, $data);

        // Check if the update was successful
        if ($result) {
            // Set a success message
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori berhasil diupdate!</div>');
        } else {
            // Set an error message
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kategori gagal diupdate!</div>');
        }

        // Redirect to the bidang page
        redirect('bapendik/sertifikat');
    }

    public function delete_kategori($id)
    {
        // Check if the ID exists in the database
        $bidang = $this->db->get_where('tb_sertif_kategori', ['id' => $id])->row_array();

        if ($bidang) {
            $this->db->where('id', $id);
            $this->db->delete('tb_sertif_kategori');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Kategori tidak ditemukan atau sudah dihapus.</div>');
        }

        redirect('bapendik/sertifikat');
    }

    public function sertif_kategori()
    {
        $data['title'] = 'Kategori Sertifikat';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kategori'] = $this->db->get('tb_sertif_kategori')->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array('required' => 'Kategori harus diisi.'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/kategori_sertif', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tb_sertif_kategori', ['kategori' => $this->input->post('kategori')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil ditambahkan!</div>');
            redirect('bapendik/sertifikat');
        }
    }

    public function tambah_mhs()
    {
        $data['title'] = 'Tambah Mahasiswa';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();



        // Validasi Form
        $this->form_validation->set_rules('nim_mhs', 'NIM', 'required|trim', [
            'required' => 'NIM Mahasiswa harus diisi!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama Mahasiswa harus diisi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'required' => 'Email Mahasiswa harus diisi!',
            'valid_email' => 'Email Mahasiswa tidak valid!',
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', [
            'required' => 'Jenis Kelamin harus diisi!'
        ]);
        $this->form_validation->set_rules('prodi_id', 'Prodi', 'required|trim', [
            'required' => 'Prodi Mahasiswa harus diisi!'
        ]);
        $this->form_validation->set_rules('telp', 'No Telp', 'required|trim', [
            'required' => 'No Telepon Mahasiswa harus diisi!'
        ]);
        $this->form_validation->set_rules('pembiayaan', 'Pembiayaan', 'required|trim', [
            'required' => 'Pembiayaan Mahasiswa harus diisi!'
        ]);
        $this->form_validation->set_rules('pa', 'Pembimbing Akademik', 'required|trim', [
            'required' => 'Pembimbing Akademik Mahasiswa harus diisi!'
        ]);
        $data['prodi'] = $this->db->get('tb_prodi')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/tambah_mhs', $data);
            $this->load->view('templates/footer');
        } else {
            $this->tambah_aksi();
        }
    }

    public function tambah_aksi()
    {
        $nim = $this->input->post('nim_mhs');
        $data_user = array(
            'nama' => htmlspecialchars($this->input->post('nama', TRUE)),
            'email' => htmlspecialchars($this->input->post('email', TRUE)),
            'image' => 'user.jpg',
            'pass' => password_hash($nim, PASSWORD_DEFAULT),
            'gender' => $this->input->post('gender'),
            'telp' => $this->input->post('telp'),
            'role_id' => 1,
            'is_active' => 1,
            'tgl_dibuat' => time(),
        );

        // Upload gambar
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $data_user['image'] = $new_image;
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->insert('tb_user', $data_user);
        $user_id = $this->db->insert_id();

        $prodi_id = $this->input->post('prodi_id');
        $data_mhs = array(
            'nim_mhs' => $nim,
            'prodi_id' => $prodi_id,
            'user_id' => $user_id,
            'pembiayaan' => $this->input->post('pembiayaan'),
            'pa' => $this->input->post('pa')
        );

        $this->db->insert('tb_mhs', $data_mhs);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('bapendik/mahasiswa');
    }

    public function edit_mhs($user_id)
    {
        $data['title'] = 'Edit Mahasiswa';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mahasiswa'] = $this->Model_Mahasiswa->getMhsById($user_id);
        $data['prodi'] = $this->db->get('tb_prodi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/edit_mhs', $data);
        $this->load->view('templates/footer');
    }

    public function update_mhs($user_id)
    {
        // Ambil data dari form
        $nim = $this->input->post('nim_mhs');
        $nama = htmlspecialchars($this->input->post('nama', TRUE));
        $email = htmlspecialchars($this->input->post('email', TRUE));
        $gender = $this->input->post('gender');
        $telp = $this->input->post('telp');
        $is_active = $this->input->post('is_active');
        $prodi_id = $this->input->post('prodi_id');
        $pembiayaan = $this->input->post('pembiayaan');
        $pa = $this->input->post('pa');
        $point = $this->input->post('point');

        // Data untuk tabel tb_user
        $data_user = array(
            'nama' => $nama,
            'email' => $email,
            'gender' => $gender,
            'telp' => $telp,
            'is_active' => $is_active
        );

        // Upload gambar profil jika ada
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['file_name'] = 'profile_' . $user_id; // Nama file diubah sesuai user_id

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $data_user['image'] = $new_image;
            } else {
                // Jika upload gagal, tampilkan pesan error
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                    . $this->upload->display_errors() .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>');
                redirect('bapendik/edit_mhs/' . $user_id);
                return;
            }
        }

        // Update data di tabel tb_user
        $this->db->where('id', $user_id);
        $this->db->update('tb_user', $data_user);

        // Data untuk tabel tb_mhs
        $data_mhs = array(
            'nim_mhs' => $nim,
            'prodi_id' => $prodi_id,
            'pembiayaan' => $pembiayaan,
            'pa' => $pa,
            'point' => $point
        );

        // Update data di tabel tb_mhs
        $this->db->where('user_id', $user_id);
        $this->db->update('tb_mhs', $data_mhs);

        // Set flashdata untuk pesan sukses dan redirect ke halaman daftar mahasiswa
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil di Perbarui!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
        redirect('bapendik/mahasiswa');
    }



    public function hapusMahasiswa($id)
    {
        // Load the model if it's not autoloaded
        $this->load->model('Model_Mahasiswa');

        // Call the delete function in the model
        $result = $this->Model_Mahasiswa->deleteMhs($id);

        // Check if the deletion was successful
        if ($result) {
            // Set a success message
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data mahasiswa berhasil dihapus!</div>');
        } else {
            // Set an error message
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data mahasiswa gagal dihapus!</div>');
        }

        // Redirect to the mahasiswa page
        redirect('bapendik/mahasiswa');
    }


    // public function edit_mhs($id)
    // {
    //     $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->index();
    //     } else {
    //         $data = array(
    //             'id' => $id,
    //             //'nim_mhs' => $nim_mhs,
    //             'nama' => $this->input->post('nama'),
    //             'email' => $this->input->post('email'),
    //             // 'pass_mhs' => $this->input->post('pass_mhs'),
    //             'gender' => $this->input->post('gender'),
    //             'prodi' => $this->input->post('prodi'),
    //             'telp' => $this->input->post('telp'),
    //             'alamat' => $this->input->post('alamat'),
    //         );

    //         $this->Model_Mahasiswa->update_data($data, 'tb_user');
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //         Data Berhasil Diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //         <span aria-hidden="true">&times;</span></button></div>');
    //         redirect('mahasiswa');
    //     }
    // }

    // public function delete_mhs($id)
    // {
    //     $where = array('id' => $id);

    //     $this->Model_Mahasiswa->delete($where, 'tb_user');
    //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //     Data Berhasil Di Hapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //         <span aria-hidden="true">&times;</span></button></div>');
    //     redirect('bapendik/mahasiswa');
    // }

    public function _rules()
    {
        $this->form_validation->set_rules('nim_mhs', 'NIM Mahasiswa', 'required|trim', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', array(
            'required' => '%s harus diisi!',
            'valid_email' => '%s tidak valid!'
        ));
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('prodi', 'Prodi Mahasiswa', 'required|trim', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('telp', 'No Telp', 'required|trim', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('pembiayaan', 'Jenis Pembiayaan', 'required|trim', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('pa', 'Pembimbing Akademik', 'required|trim', array(
            'required' => '%s harus diisi!'
        ));
    }
}
