<?php
function rupiah($angka)
{
    $jadi = number_format($angka,0,',','.');
    return $jadi;
}
date_default_timezone_set('Asia/Makassar'); 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Accounting Aplication</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"> 
    <link rel="stylesheet" href="../reception/css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="box.css"> 
    <link rel="stylesheet" type="text/css" href="bootstrap/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.16/css/dataTables.bootstrap.min.css">


    <script src = "../lib/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
    <script src="../reception/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/jquery.PrintArea.js"></script>
    <script type="text/javascript" src="js/jquery.tabledit.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>


    <style type="text/css">
        .my-group .form-control{
            width:50%;
        }

        .tab {
          width: 100%;
          max-width: 100%;
          margin-bottom: 1rem;
          margin-top: 5rem;
          background-color: transparent;
          font-size: 11px;
        }

        .tab th,
        .tab td {
          padding: 0.05rem;
          vertical-align: top;
          text-align: center;
        }
    </style>

</head>
<body>
	
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>
    

    <script type="text/javascript">
        $(function(){
            $("#start").datepicker({
                dateFormat:'yy/mm/dd'
            });

            $("#end").datepicker({
                dateFormat:'yy/mm/dd'
            });

            $('#date_d_r').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 'd',
                maxDate: '+1m'
            })

        });
    </script>


</body>
</html>