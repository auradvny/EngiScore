<?= $this->session->flashdata('pesan'); ?>
                <form action="<?= base_url('mahasiswa/pengajuan'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="capaian">Capaian</label>
                            <input type="text" class="form-control" id="capaian" name="capaian" placeholder="Nama Capaian">
                            <?= form_error('capaian', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="bidang">Bidang</label>
                            <div class="form-group">
                                <select name="bidang" id="bidang" class="form-control">
                                    <option value="">Pilih Bidang</option>
                                    <?php foreach ($bidang as $b) : ?>
                                        <option value="<?= $b['id']; ?>"><?= $b['bidang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= form_error('bidang', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <div class="form-group">
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= form_error('kategori', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control" id="file" name="file">
                            <?= form_error('file', "<div class='alert alert-danger' role='alert'>", '</div>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Reset</button>
                    </div>
                </form>