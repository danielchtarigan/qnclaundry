<?php
session_start();
include '../config.php';
include 'auth.php';

date_default_timezone_set('Asia/Makassar');

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}

if (!isset($_SESSION['user_id']) and !isset($_SESSION['level']) and !isset($_SESSION['outlet']))
    {
        ?>
        <script type="text/javascript">
         location.href="http://qnclaundry.com";
        </script>
<?php
    } 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Halaman Admin</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="../css/sb-admin-2.css" rel="stylesheet">
        <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    	
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables_themeroller.css" />        
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.yadcf.css">
        <link rel="stylesheet" type="text/css" href="../admin/css/dataTables.tableTools.css">
        <link rel="stylesheet" type="text/css" href="../admin/css/jquery.dataTables.min.css">
    
    	<script src = "../lib/js/jquery-2.1.3.min.js"></script>
        <script src = "../lib/js/bootstrap.min.js"></script>
        <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
        <script src="../js/sb-admin-2.js"></script>
        
        <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
        <script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.yadcf.js"></script>
        <script type="text/javascript" src="../admin/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="../admin/js/dataTables.tableTools.js"></script>
	

    </head>
    <body>
    	
    	<?php require 'nav.php'; ?>
    
    
    </body>

</html>
