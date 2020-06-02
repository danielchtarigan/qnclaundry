<?php 
include '../config.php';
  session_start();
  
  date_default_timezone_set('Asia/Makassar');
	  
       $us=$_SESSION['user_id'];
    	$jam=date("Y-m-d H:i:s");
  mysqli_query($con,"update reception set spk=1,rcp_spk='$us',tgl_spk='$jam' WHERE no_nota='$_POST[no_nota]'");
  
  ?>
<head>
<title>SPK</title>
<a href="input.php"> Kembali</a>
<style>
.input1 {
	height: 20px;
	font-size: 12px;
	padding-left: 5px;
	margin: 5px 0px 0px 5px;
	width: 97%;
	border: none;
	color: red;
}
table {
	border: 1px solid #cecece;
}
.td {
	border: 1px solid #cecece;
}
#kiri{
width:50%;
float:left;
}

#kanan{
width:50%;
float:right;
padding-top:5px;
margin-bottom:9px;
}
</style>
</head>

<body onload="window.print()">
<?php 
  include "../config.php";
  include"bar128.php";

echo "<center><h2 style='margin-bottom:3px;'>SPK</h2></center><hr/>";
   $edit = mysqli_query($con,"SELECT * FROM reception WHERE no_nota='$_POST[no_nota]'");
    $r    = mysqli_fetch_array($edit);
	echo bar128(stripslashes($_POST['no_nota']));
    echo "<div class='post_title'><b>Customer</b></div>
    
          <form method=POST >
          <input type=hidden name=id value=$r[id]>
          <table width=100%>
          <tr><td style='width:100px'>
          No Nota</td>        
          <td> : $r[no_nota]</td>
          </tr>
          <tr>
          <td>Customer</td> 
          <td> :  $r[nama_customer]</td>
          </tr>
          <tr>
          <td>Keterangan</td> 
          <td> :  $r[ket]</td>
          </tr>
          
          </table></form>";
  // tampilkan rincian produk yang di order
  $sql2=mysqli_query($con,"SELECT * FROM detail_spk WHERE no_nota= '$_POST[no_nota]'");
  
  echo "<table width=100%>
        <tr style='color:#fff; height:35px;' bgcolor=#000><th style='width:50px'>Item</th><th style='width:50px'>Jumlah</th></tr>";
  
  while($s=mysqli_fetch_array($sql2)){
    	
    echo "<tr><td>$s[jenis_item]</td><td>$s[jumlah]</td></tr>";
  }   
$sql3=mysqli_query($con,"SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota= '$_POST[no_nota]'");
$s1=mysqli_fetch_array($sql3);
echo "<div class='post_title'><b>Detail Item.</b></div>
	  <table width=100%>
	  <tr><td>Total</td><td> $s1[total] <b></b></td></tr>   
      </table>
      <tr><td col>
      
      <br/><span style='float:right; text-align:center;'>
							Tgl $jam			Reception :$_SESSION[user_id]</span></td></tr>";
	  
?>