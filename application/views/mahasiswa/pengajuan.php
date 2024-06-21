<?= $this->session->flashdata('pesan'); ?>
<form action="<?= base_url('mahasiswa/pengajuan'); ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="form-group">
            <label for="bidang_id">Bidang</label>
            <div class="form-group">
                <select name="bidang_id" id="bidang_id" class="form-control">
                    <option value="" disabled <?= empty($user['bidang']) ? 'selected' : ''; ?>>Pilih Bidang</option>
                    <?php foreach ($bidang as $b) : ?>
                        <option value="<?= $b['id']; ?>"><?= $b['bidang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?= form_error('bidang_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>
        <div class="form-group">
            <label for="capaian_id">Capaian</label>
            <div class="form-group">
                <select name="capaian_id" id="capaian_id" class="form-control">
                    <option value="" disabled <?= empty($user['capaian']) ? 'selected' : ''; ?>>Pilih Capaian</option>
                    <?php foreach ($capaian as $c) : ?>
                        <option value="<?= $c['id']; ?>"><?= $c['capaian']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?= form_error('capaian_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>
        <div class="form-group">
            <label for="kategori_id">Kategori</label>
            <div class="form-group">
                <select name="kategori_id" id="kategori_id" class="form-control">
                    <option value="" disabled <?= empty($user['kategori']) ? 'selected' : ''; ?>>Pilih Kategori</option>
                    <?php foreach ($kategori as $k) : ?>
                        <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?= form_error('kategori_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>
        <div class="form-group">
            <label for="file">File</label>
            <input type="file" class="form-control" id="file" name="file">
            <?= form_error('file', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
    </div>
</form>

<div class="col-lg-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Bidang</th>
                <th scope="col">Capaian</th>
                <th scope="col">Kategori</th>
                <th scope="col">File</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($permohonan as $p) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $p['bidang']; ?></td>
                    <td><?= $p['capaian']; ?></td>
                    <td><?= $p['kategori']; ?></td>
                    <td>
                        <img src="<?= base_url('assets/img/sertifikat/' . $p['file']); ?>" alt="Sertifikat" style="width:100px; height:auto;">
                    </td>
                    <td>
                        <?php
                        if ($p['persetujuan'] == 0) {
                            echo 'Belum Disetujui';
                        } elseif ($p['persetujuan'] == 1) {
                            echo 'Disetujui';
                        } elseif ($p['persetujuan'] == 2) {
                            echo 'Ditolak';
                        } else {
                            echo 'Status Tidak Diketahui';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>