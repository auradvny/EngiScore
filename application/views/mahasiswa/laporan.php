<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/template/plugins/bootstrap/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f9f9fa;
            font-family: Arial, sans-serif;
        }

        .page-content {
            padding: 20px;
        }

        .card {
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 30px;
        }

        .user-profile {
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 5px 0 0 5px;
        }

        .user-profile img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }

        .user-details {
            padding: 20px;
        }

        .user-details h6 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .user-details p {
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .social-link {
            list-style-type: none;
            padding: 0;
        }

        .social-link li {
            display: inline-block;
            margin-right: 10px;
        }

        .social-link li a {
            color: #007bff;
            font-size: 24px;
            text-decoration: none;
        }

        .text-muted {
            color: #919aa3 !important;
        }
    </style>
</head>

<body>
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-md-12">
                <div class="card user-card-full mx-auto">
                    <div class="row m-0">
                        <div class="col-sm-12 user-details">
                            <div class="card-block">
                                <table class="table" border="0" id="example">
                                    <thead>
                                        <tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="4">
                                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="User-Profile-Image" width="200px">
                                            </td>
                                            <td align='center' colspan='2'>
                                                <h6 style="background-color: blue; padding: 5px; text-align:left; color:#fff;">Biodata</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="m-b-10 f-w-600">Nama</p>
                                            </td>
                                            <td>
                                                <h6 class="text-muted f-w-400"><?= isset($user['nama']) ? $user['nama'] : ''; ?></h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="m-b-10 f-w-600">NIM</p>
                                            </td>
                                            <td>
                                                <h6 class="text-muted f-w-400"><?= isset($nim_mhs) ? $nim_mhs : ''; ?></h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="m-b-10 f-w-600">Jumlah Point</p>
                                            </td>
                                            <td>
                                                <h6 class="text-muted f-w-400"><?= isset($points) ? $points : ''; ?></h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include DataTables and extensions -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#example").DataTable({
                paging: false,
                info: false,
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "pdf", "print"],
            });
        });
    </script>
</body>

</html>