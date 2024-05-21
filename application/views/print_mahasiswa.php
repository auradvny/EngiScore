<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Mahasiswa</title>
</head>
<body>
    <table border='1'>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Password</th>
            <th>Prodi</th>
            <th>Jenis Kelamin</th>
            <th>No Telp</th>
            <th>Alamat</th>
        </tr>
        <?php $no = 1;
        foreach($mahasiswa as $mhs) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $mhs->nim_mhs ?></td>
            <td><?= $mhs->nama_mhs ?></td>
            <td><?= $mhs->email_mhs ?></td>
            <td><?= $mhs->pass_mhs ?></td>
            <td><?= $mhs->prodi_mhs ?></td>
            <td><?= $mhs->jekel_mhs ?></td>
            <td><?= $mhs->telp_mhs ?></td>
            <td><?= $mhs->alamat_mhs ?></td>
        </tr>
        <?php endforeach ?>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>