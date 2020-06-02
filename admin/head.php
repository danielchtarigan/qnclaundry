<?php
session_start();
include 'auth.php';

date_default_timezone_set('Asia/Makassar');

function rupiah($angka)
{
	$jadi = "Rp ".number_format($angka,0,'.',',');
	return $jadi;
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
        <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	

<!--	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	
	

</head>
<body>
	
	<?php require 'nav.php'; ?>
	
	
	
	
	
	
	

		
	
<script src = "../lib/js/jquery-2.1.3.min.js"></script>
   <script src = "../lib/js/bootstrap.min.js"></script>
 <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>
   
<script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.yadcf.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script src="../lib/js/jquery.form.js"></script>

<script type="text/javascript">
 $('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
    });
</script>
   	</body>

</html>
