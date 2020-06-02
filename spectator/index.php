<?php
session_start();
include '../config.php';
function rupiah($angka)
{
    $jadi = "Rp.".number_format($angka,0,',','.');
    return $jadi;
}
date_default_timezone_set('Asia/Makassar');
 
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
    <title>Halaman Spectator</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <script src="../js/jquery-1.11.0.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
</head>
<body>
	
	<?php require 'nav.php'; ?>
    
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>



</body>
</html>