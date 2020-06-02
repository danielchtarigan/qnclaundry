<?php
include 'config.php';
session_start();
?>
<html>

<head>
    <title>QnC Aplication</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function klik(){
	var x=document.login.nama_outlet.value;
	var res = x.split("^");
	lat = res[1];
	long = res[2];
//	alert(res[0]+" dan "+res[1]);
}
</script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                <div align="center">
                <img src="logo.png">
                </div>
                <?php
                if (isset($_GET['status'])){
					if ($_GET['status']=="receptionist"){
						if (isset($_GET['nama_outlet'])){
							$outlet = $_GET['nama_outlet'];
							$ot = explode("^", $outlet);
							$_SESSION['nama_outlet']=$ot[0];

?>
                    <div class="panel-body">
                        <form action="ceklogin.php" method="POST" name="login" id="login">
                        	<input type="hidden" name="nama_outlet" value="<?php echo $ot[0];?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="username" name="uname" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="password" name="passwd" type="password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="latitude" name="lat" type="text" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="longitude" name="long" type="text" value="" readonly>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">                                
                            </fieldset>                        
                        </form>
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div>
                    <?php                    
					include "current.php";
					?>
                    </div>
<?php							
							}
							else{
?>
                    <div class="panel-body">
                        <form action="login.php" method="GET" name="login" onSubmit="klik()">
                        	<input type="hidden" name="status" value="receptionist">
                            <fieldset>
                                <div class="form-group">
                                    <select class="form-control" name="nama_outlet" id="nama_outlet">
										<option value="">Nama Outlet</option>
                                        <?php
                                        $outlet = mysqli_query($con, "select * from outlet");
										while ($ro = mysqli_fetch_array($outlet)){
?>
										<option value="<?php echo $ro['nama_outlet']."^".$ro['latitude']."^".$ro['longitude']; ?>"><?php echo $ro['nama_outlet'];?></option>
<?php
										}
										?>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">                                
                            </fieldset>                        
                        </form>
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
<?php						
							}
					}
					else{
?>
                    <div class="panel-body">
                        <form role="form1" action="ceklogin.php" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="username" name="uname" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="password" name="passwd" type="password">
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">                                
                            </fieldset>                        
                        </form>
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
<?php					
					}
				}
				else{
				?>
                    <div class="panel-body">
                            <fieldset>
                             <a href="login.php?status=workshop">
                              <input type="button" class="btn btn-lg btn-success btn-block" value="Workshop / Staff">
                             </a>
                             <a href="login.php?status=receptionist">
                              <input type="button" class="btn btn-lg btn-success btn-block" value="Receptionist">
                             </a>
                            </fieldset>                        
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <?php
					}
					?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>