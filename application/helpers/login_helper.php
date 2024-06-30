<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        // Mendapatkan id menu dari tabel tb_user_menu
        $queryMenu = $ci->db->get_where('tb_user_menu', ['menu' => $menu])->row_array();
        if (!$queryMenu) {
            // Jika menu tidak ditemukan, redirect ke halaman error
            redirect('auth/blocked');
        }

        $menu_id = $queryMenu['id'];

        // Mengecek akses pengguna berdasarkan role_id dan menu_id
        $userAccess = $ci->db->get_where('tb_user_akses_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            // Jika akses tidak ditemukan, redirect ke halaman blocked
            redirect('auth/blocked');
        }
    }
}


function get_dashboard_url($role_id)
{
    switch ($role_id) {
        case 1:
            return 'mahasiswa'; // Misalnya, role_id 1 untuk admin
        case 2:
            return 'bapendik'; // Misalnya, role_id 2 untuk user biasa
            // Tambahkan kasus lainnya sesuai dengan role_id yang ada
        default:
            return 'auth'; // Default redirect jika role_id tidak dikenal
    }
}
