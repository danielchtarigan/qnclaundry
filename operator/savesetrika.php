<?php 
include '../config.php';
session_start();
	   $no_nota=$_POST['no_nota'];
    	$jumlah1=$_POST['jumlah1'];
    	$berat=$_POST['berat'];
       $setrika=$_POST['setrika'];
       $ket=$_POST['ket'];
		$us=$_SESSION['user_id'];

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
	$q=mysqli_query($con,"insert into setrika (tgl_setrika,user_setrika,no_nota,berat) VALUES('$jam','$setrika','$no_nota','$berat')");
	 $query="update reception set setrika='1',tgl_setrika='$jam',user_setrika='$setrika'  WHERE no_nota = '$no_nota'";
	 $hasil=mysqli_query($con,$query);
	 if($hasil){

	 	$edit = mysqli_query($con,"SELECT * FROM setrika WHERE no_nota='$_POST[no_nota]'");
    $r    = mysqli_fetch_array($edit);
	 	
	 echo '<font color="green">Setrika</font>';
	 echo "
          <form method=POST >
          <input type=hidden name=id value=$r[id]>
          <table width=100%>
          <tr>
          <td style='width:50px'>
          Setrika
          </td>        
          <td> : $r[user_setrika]</td>
          </tr>
          
          <tr><td>
          No Nota</td>        
          <td> : $r[no_nota]</td>
          </tr>
          <tr>
          <td>berat</td> 
          <td> :  $r[berat]</td>
          </tr>
          </table></form>";
	}
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
