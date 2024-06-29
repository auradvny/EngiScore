<div class="col-lg-12">
    <div class="col-lg-6 mb-4">
        <table class="table" border="0">
            <tbody>
                <tr>
                    <td><strong>Nama Mahasiswa</strong></td>
                    <td><?= isset($user['nama']) ? $user['nama'] : ''; ?></td>
                </tr>
                <tr>
                    <td><strong>NIM Mahasiswa</strong></td>
                    <td><?= isset($nim_mhs) ? $nim_mhs : ''; ?></td>
                </tr>
                <tr>
                    <td><strong>Jumlah Poin</strong></td>
                    <td><?= isset($points) ? $points : ''; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <table id="example1" class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Bidang</th>
                <th scope="col">Capaian</th>
                <th scope="col">Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($permohonan) && !empty($permohonan)) : ?>
                <?php $i = 1; ?>
                <?php foreach ($permohonan as $p) : ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= !empty($p['bidang']) ? $p['bidang'] : '<i>Tidak Tersedia</i>'; ?></td>
                        <td><?= !empty($p['capaian']) ? $p['capaian'] : '<i>Tidak Tersedia</i>'; ?></td>
                        <td><?= !empty($p['kategori']) ? $p['kategori'] : '<i>Tidak Tersedia</i>'; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center"><i>Data tidak tersedia</i></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.9/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.2.9/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            "lengthChange": false,
            "buttons": [{
                    extend: 'excelHtml5',
                    title: 'Laporan Mahasiswa',
                    messageTop: function() {
                        return 'Nama: <?= isset($user["nama"]) ? $user["nama"] : ""; ?>\nNIM: <?= isset($nim_mhs) ? $nim_mhs : ""; ?>\nJumlah Point: <?= isset($points) ? $points : ""; ?>';
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: 'Laporan Mahasiswa',
                    messageTop: function() {
                        return 'Nama: <?= isset($user["nama"]) ? $user["nama"] : ""; ?>\nNIM: <?= isset($nim_mhs) ? $nim_mhs : ""; ?>\nJumlah Point: <?= isset($points) ? $points : ""; ?>';
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Laporan Mahasiswa',
                    messageTop: function() {
                        return 'Nama: <?= isset($user["nama"]) ? $user["nama"] : ""; ?>\nNIM: <?= isset($nim_mhs) ? $nim_mhs : ""; ?>\nJumlah Point: <?= isset($points) ? $points : ""; ?>';
                    }
                },
                {
                    extend: 'print',
                    title: 'Laporan Mahasiswa',
                    messageTop: function() {
                        return 'Nama: <?= isset($user["nama"]) ? $user["nama"] : ""; ?>\nNIM: <?= isset($nim_mhs) ? $nim_mhs : ""; ?>\nJumlah Point: <?= isset($points) ? $points : ""; ?>';
                    }
                }
            ]
        });

        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>