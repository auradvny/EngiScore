<div class="card-body">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>NIM</th>
                <th>Bidang</th>
                <th>Kategori</th>
                <th>Capaian</th>
                <th>File</th>
                <th>Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($verifikasi as $verif) : ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $verif['nim_mhs']; ?></td>
                    <td><?= $verif['bidang_id']; ?></td>
                    <td><?= $verif['kategori_id']; ?></td>
                    <td><?= $verif['capaian_id']; ?></td>
                    <td><?= $verif['file']; ?></td>
                    <td>
                        <?php if ($verif['persetujuan'] == 1) : ?>
                            <select>
                                <option value="1">Setuju</option>
                            </select>
                        <?php elseif ($verif['persetujuan'] == 2) : ?>
                            <select>
                                <option value="2">Tolak</option>
                            </select>
                        <?php endif; ?>
                    </td>
                </tr>
        </tbody>
    <?php endforeach ?>
    </table>
</div>