<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="..." width="200">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['tgl_dibuat']); ?></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->



<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="calonmahasiswa-update">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Biodata: <span style="text-transform: uppercase;"><?= $user['nama']; ?></span></h3>
                </div>
                <div class=" card-body">

                    <form id="w0" action="/dashboardmhs/updatebiodata" method="post">
                        <input type="hidden" name="_csrf" value="5mUVHTS4esRonNyWpQJ9VwJPwkSeDAu1-cWfWuHV-YCkD3htYsg3lj3fj8XPSiskbHnwJa18f-qt99AijJONxA==">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Biodata</h3>
                                <div class="form-group field-calonmahasiswa-noujian required">
                                    <label class="control-label" for="calonmahasiswa-nim">NIM</label>
                                    <input type="text" id="calonmahasiswa-nim" class="form-control" name="Calonmahasiswa[nim]" value="H1D022015" maxlength="25" aria-required="true" readonly="true">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-nama required">
                                    <label class="control-label" for="calonmahasiswa-nama">Nama Pegawai</label>
                                    <input type="text" id="calonmahasiswa-nama" class="form-control" name="Calonmahasiswa[nama]" value="AURA DEVANY SALSABILA BACHTIAR" maxlength="25" aria-required="true" readonly="true">
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group field-calonmahasiswa-kodeagama required">
                                    <label class="control-label" for="calonmahasiswa-kodeagama">Agama</label>
                                    <select id="calonmahasiswa-kodeagama" class="form-control" name="Calonmahasiswa[kodeagama]" aria-required="true">
                                        <option value="1" selected>ISLAM</option>
                                        <option value="2">KATOLIK</option>
                                        <option value="3">KRISTEN</option>
                                        <option value="4">HINDU</option>
                                        <option value="5">BUDHA</option>
                                        <option value="6">KHONGHUCU</option>
                                        <option value="0">BELUM DIISI</option>
                                        <option value="7">ALIRAN KEPERCAYAAN</option>
                                    </select>

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-goldar">
                                    <label class="control-label" for="calonmahasiswa-goldar">Golongan Darah</label>
                                    <select id="calonmahasiswa-goldar" class="form-control" name="Calonmahasiswa[goldar]">
                                        <option value="4">-</option>
                                        <option value="2">AB</option>
                                        <option value="1" selected>B</option>
                                        <option value="0">A</option>
                                        <option value="3">O</option>
                                        <option value="-">-</option>
                                    </select>

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-tempatlahir required">
                                    <label class="control-label" for="calonmahasiswa-tempatlahir">Tempat Lahir</label>
                                    <input type="text" id="calonmahasiswa-tempatlahir" class="form-control" name="Calonmahasiswa[tempatlahir]" value="CILACAP" maxlength="200" aria-required="true">

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-tgllhrmhs required">
                                    <label class="control-label" for="calonmahasiswa-tgllhrmhs">Tanggal Lahir Mahasiswa (Tahun-Bulan-Tanggal)</label>
                                    <input type="text" id="calonmahasiswa-tgllhrmhs" class="form-control" name="Calonmahasiswa[tgllhrmhs]" value="2003-11-14" placeholder="Pilih Tanggal Lahir Mahasiswa" style="cursor: pointer;">


                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-goldar">
                                    <label class="control-label" for="calonmahasiswa-goldar">Jenis Kelamin</label>
                                    <select id="calonmahasiswa-goldar" class="form-control" name="Calonmahasiswa[goldar]">
                                        <option value="2">PEREMPUAN</option>
                                        <option value="1" selected>LAKI-LAKI</option>
                                        <option value="0">BELUM DIISI</option>
                                    </select>

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-nohp required">
                                    <label class="control-label" for="calonmahasiswa-nohp">No HP</label>
                                    <input type="text" id="calonmahasiswa-nohp" class="form-control" name="Calonmahasiswa[nohp]" value="083844855383" maxlength="25" aria-required="true">

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-email required">
                                    <label class="control-label" for="calonmahasiswa-email">Email</label>
                                    <input type="text" id="calonmahasiswa-email" class="form-control" name="Calonmahasiswa[email]" value="auradevany14@gmail.com" maxlength="50" aria-required="true">

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group field-calonmahasiswa-alamatasalmhs">
                                    <label class="control-label" for="calonmahasiswa-alamatasalmhs">Alamat Pegawai</label>
                                    <textarea id="calonmahasiswa-alamatasalmhs" class="form-control" name="Calonmahasiswa[alamatasalmhs]" rows="3">JALAN BALAIDESA NO. 9 RT.01/05 CIMANGGU, KECAMATAN CIMANGGU</textarea>

                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a class="btn btn-secondary" href="/site/index">Kembali</a>
                                </div>

                            </div>

                    </form>
                </div>
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
</div>
</div>
<!-- /.content -->