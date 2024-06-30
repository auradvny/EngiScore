<div class="card-header">
    <a href="<?= base_url('bapendik/verifikasi') ?>" class="btn btn-secondary btn-sm"><i class="fas da-plus"></i>Kembali</a>
</div>
<div class="card-body">
    <form action="<?= base_url('bapendik/tambah_verif'); ?>" method="POST">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>NIM</th>
                    <th>Bidang</th>
                    <th>Capaian</th>
                    <th>Kategori</th>
                    <th>Tanggal Verifikasi</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($verifikasi as $verif) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $verif['nim_mhs']; ?></td>
                        <td><?= !empty($verif['bidang']) ? $verif['bidang'] : '<i>Tidak Tersedia</i>'; ?></td>
                        <td><?= !empty($verif['capaian']) ? $verif['capaian'] : '<i>Tidak Tersedia</i>'; ?></td>
                        <td><?= !empty($verif['kategori']) ? $verif['kategori'] : '<i>Tidak Tersedia</i>'; ?></td>
                        <td><?= date('d F Y H:i', $verif['tgl_verif']); ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalGambar<?= $verif['id']; ?>">
                                <img src="<?= base_url('assets/img/sertifikat/' . $verif['file']); ?>" alt="Sertifikat" style="width:100px; height:auto;">
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="modalGambar<?= $verif['id']; ?>" tabindex="-1" aria-labelledby="modalGambarLabel<?= $verif['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalGambarLabel<?= $verif['id']; ?>">SERTIFIKAT - <span style="font-weight: bold;"><?= $verif['nim_mhs']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= base_url('assets/img/sertifikat/' . $verif['file']); ?>" alt="Sertifikat" style="width:100%; height:auto;">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url('assets/img/sertifikat/' . $verif['file']); ?>" class="btn btn-primary" download>Unduh</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
            </tbody>
        <?php endforeach ?>
        </table>
    </form>
</div>