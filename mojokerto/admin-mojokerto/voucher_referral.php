<!DOCTYPE html>
<html lang="en">
<?php
include 'index.php';
include '../configurasi/koneksi.php';
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	<link href="../../dist/css/timeline.css" rel="stylesheet">
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->

       <?php
             include 'nav.php';
           ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Voucher Referral</h1>
                </div>
            </div>
            <?php
            $qdiskref = $mysqli->query( "SELECT value FROM settings WHERE name='diskon_referral_mojokerto'");
            $diskon = $qdiskref->fetch_array()[0];
            ?>
            			<div class="col-md-8 col-md-offset-0" >
            			<form action="../fungsi/save_diskon_referral.php" method="get" class="form-horizontal">
            				<br>
            				<div class="form-group">
            					<label for="no_nota" class="control-label col-xs-3" style="text-align:left">
            						Persen Diskon
            					</label>
            					<div class="col-xs-4">
            						<input type="text" name="diskon" value="<?php echo $diskon; ?>">
            					</div>
            					%
            				</div>
            				<button type="submit" class="btn btn-default">Save</button>
            			</form>
            			</div>

            <form action="../fungsi/save_sms_referral.php" class="form-horizontal">
            <?php
            $qsmsreferral = $mysqli->query( "SELECT value FROM settings WHERE name='sms_referral_mojokerto'");
            $smsreferral = $qsmsreferral->fetch_array()[0];
            ?>
            <div class="col-md-8" >
            	<br>
            	<div class="form-group">
            		<label for="no_nota" class="control-label col-xs-3" >
            			<p align="left">SMS Referral<br>
            				<small style="font-weight:normal"><b>[KODE]</b> akan otomatis diganti dengan kode referral dan <b>[DISKON]</b> akan diganti dengan persentase diskon</small>
            			</p>
            		</label>
            		<div class="col-xs-4">
            			<textarea name="sms_referral" id="sms_referral" cols="50" rows="10"><?php echo $smsreferral; ?></textarea>
            		</div>
            	</div>
            	<button type="submit" class="btn btn-default">Save SMS</button>
            </div>
            </form>
          </div>
          <!-- /#wrapper -->

          <script src="../../../lib/js/jquery-2.1.4.min.js"></script>
          <script src="../../../lib/js/bootstrap.min.js"></script>
          <script src="../../dist/js/metisMenu.js"></script>
          <script src="../../dist/js/sb-admin-2.js"></script>

      </body>

      </html>
