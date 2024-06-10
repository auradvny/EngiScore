<?= $this->session->flashdata('pesan'); ?>
<form action="<?= base_url('mahasiswa/pengajuan'); ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="form-group">
            <label for="capaian_id">Capaian</label>
            <div class="form-group">
                <select name="capaian_id" id="capaian_id" class="form-control">
                    <option value="">Pilih Capaian</option>
                    <?php foreach ($capaian as $c) : ?>
                        <option value="<?= $c['id']; ?>"><?= $c['capaian']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?= form_error('capaian_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>
        <div class="form-group">
            <label for="bidang_id">Bidang</label>
            <div class="form-group">
                <select name="bidang_id" id="bidang_id" class="form-control">
                    <option value="">Pilih Bidang</option>
                    <?php foreach ($bidang as $b) : ?>
                        <option value="<?= $b['id']; ?>"><?= $b['bidang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?= form_error('bidang_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>
        <div class="form-group">
            <label for="kategori_id">Kategori</label>
            <div class="form-group">
                <select name="kategori_id" id="kategori_id" class="form-control">
                    <option value="">Pilih Kategori</option>
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
