<?php 
session_start();
include '../auth.php';
include '../../config.php';
include '../code_order.php';
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}


$user_id = $_SESSION['user_id'];

$scb = ($_SESSION['subagen']<>'') ? $user_id : "Delivery";


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Riwayat Transaksi</title>
    <link rel="icon" href="../../Logo bulat 2017.png">
    <link href="../../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/stbootstrap.min.css" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
               <img src="../../Logo 2017.png" width="100%">
            </div>

            <ul class="list-unstyled components">
                <li class="">
                    <a href="../index.php">Beranda</a>
                </li>
                <li>
                    <a href="?">Riwayat</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="../../logout.php" class="article"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-default d-lg-none">
                        <i class="fa fa-align-left"></i>
                        <span></span>
                    </button>
                    <!-- <button class="btn btn-white d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                        </ul>
                    </div> -->
                    <a class="navbar-brand" href="#" style="color: white"><?php echo $user_id ?></a>

                </div>  
            </nav>

            <div class="panel panel-default">
                <div class="panel-body">
                    <?php 
                    if(isset($_GET['id'])){
                        include 'detail_faktur.php';
                    } else { ?>
                        <legend>Riwayat Transaksi</legend>
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed table-hover table-striped" id="rekap" style="font-size: 14px">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nomor Faktur</th>
                                        <th>Nama Customer</th>
                                        <th>Total Bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total = 0;
                                    $sql = mysqli_query($con, "SELECT * FROM faktur_penjualan LEFT JOIN customer ON faktur_penjualan.id_customer=customer.id WHERE faktur_penjualan.no_faktur LIKE '%$kode_faktur%' AND faktur_penjualan.sub_cabang='$scb' ");
                                    while($rData = mysqli_fetch_array($sql)){
                                        $total += $rData['total'];
                                        ?>
                                        <tr>
                                            <td><?= $rData['tgl_transaksi'] ?></td>
                                            <td><?= $rData['no_faktur'] ?></td>
                                            <td><?= $rData['nama_customer'] ?></td>
                                            <td align="right"><?= number_format($rData['total']) ?></td>
                                            <td align="center"><a class="detail" href="#" id="<?= $rData['no_faktur'] ?>">Detail</a></td>
                                        </tr>
                                        <?php 
                                    }

                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="text-align: right; font-weight:bolder; background-color: #8deeeb" colspan="3">Total</td>
                                        <td class="total" style="text-align: right; font-weight:bolder; background-color: #8deeeb"><?= number_format($total) ?></td>  
                                        <td class="" style="text-align: center; font-weight: bolder; background-color: #8deeeb"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php 
                    }

                    ?>

                        
                </div>
            </div>
        </div>
    </div>

    <script src = "../../lib/js/jquery-2.1.3.min.js"></script>
   
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap4.1.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('.navbar-brand').toggle();
            });

            $('.detail').on('click', function(){
                var faktur = $(this).attr('id');
                window.open('?id='+faktur+'','_blank').focus();
            })

            $('#rekap').DataTable({
                "aaSorting":[[0, "desc"]],
                "sPaginationType":"full_numbers",
                "bJQueryUI":true,
                "lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
            });
        });
    </script>

</body>
</html>

    



        

    