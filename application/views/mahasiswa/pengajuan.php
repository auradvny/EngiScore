<form action="<?= base_url('mahasiswa/pengajuan'); ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
        <!-- Bidang -->
        <div class="form-group">
            <label for="bidang_id">Bidang</label>
            <div class="form-group">
                <select name="bidang_id" id="bidang_id" class="form-control">
                    <option value="" disabled selected>Pilih Bidang</option>
                    <?php foreach ($bidang as $b) : ?>
                        <option value="<?= $b['id']; ?>"><?= $b['bidang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?= form_error('bidang_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>

        <!-- Capaian -->
        <div class="form-group">
            <label for="capaian_id">Capaian</label>
            <div class="form-group">
                <select name="capaian_id" id="capaian_id" class="form-control">
                    <option value="" disabled selected>Pilih Capaian</option>
                </select>
            </div>
            <?= form_error('capaian_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>

        <!-- Kategori -->
        <div class="form-group">
            <label for="kategori_id">Kategori</label>
            <div class="form-group">
                <select name="kategori_id" id="kategori_id" class="form-control">
                    <option value="" disabled selected>Pilih Kategori</option>

                </select>
            </div>
            <?= form_error('kategori_id', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>

        <!-- File -->
        <div class="form-group">
            <label for="file">File</label>
            <input type="file" class="form-control" id="file" name="file">
            <?= form_error('file', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
        </div>

        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
    </div>
</form>

<div class="col-lg-12 mt-4">
    <h4>DAFTAR SERTIFIKAT</h4>
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
                        <?php if (in_array(pathinfo($p['file'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'pdf'])) : ?>
                            <a href="<?= base_url('assets/img/sertifikat/') . $p['file']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-download"></i> Download</a>
                        <?php else : ?>
                            <span>File tidak didukung</span>
                        <?php endif; ?>
                    </td>
                    <!-- <td>
                        <img src="<?= base_url('assets/img/sertifikat/' . $p['file']); ?>" alt="Sertifikat" style="width:100px; height:auto;">
                    </td> -->
                    <td>
                        <?php
                        if ($p['persetujuan'] == 0) {
                            echo 'Belum Disetujui';
                        } elseif ($p['persetujuan'] == 1) {
                            echo 'Disetujui';
                        } elseif ($p['persetujuan'] == 2) {
                            echo 'Ditolak';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('bidang_id').addEventListener('change', function() {
        var bidang_id = this.value;
        fetch('<?= base_url('mahasiswa/getCapaianByBidang/'); ?>' + bidang_id)
            .then(response => response.json())
            .then(data => {
                var capaianSelect = document.getElementById('capaian_id');
                capaianSelect.innerHTML = '<option value="" disabled selected>Pilih Capaian</option>';
                var uniqueCapaian = [];
                data.forEach(function(capaian) {
                    if (!uniqueCapaian.includes(capaian.id)) {
                        uniqueCapaian.push(capaian.id);
                        var option = document.createElement('option');
                        option.value = capaian.id;
                        option.textContent = capaian.capaian;
                        capaianSelect.appendChild(option);
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('capaian_id').addEventListener('change', function() {
        var bidang_id = document.getElementById('bidang_id').value;
        var capaian_id = this.value;
        fetch('<?= base_url('mahasiswa/getKategoriByBidangAndCapaian/'); ?>' + bidang_id + '/' + capaian_id)
            .then(response => response.json())
            .then(data => {
                var kategoriSelect = document.getElementById('kategori_id');
                kategoriSelect.innerHTML = '<option value="" disabled selected>Pilih Kategori</option>';
                data.forEach(function(kategori) {
                    var option = document.createElement('option');
                    option.value = kategori.id;
                    option.textContent = kategori.kategori;
                    kategoriSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    });
</script>