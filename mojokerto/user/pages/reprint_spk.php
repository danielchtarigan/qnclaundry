<?php
include '../../../config.php';


      $id_cs=$_GET['id_cs'];
    $no_nota=$_GET['no_nota'];
    $sql5=$con->query("SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota= '$no_nota'");
$r = $sql5->fetch_assoc();
  $t=$r['total'];  
    
  
   
    
    	include"../../../reception/bar128.php";
    	$edit = mysqli_query($con,"SELECT * FROM reception WHERE id='$id_cs'");
    	$r    = mysqli_fetch_array($edit);
    	$jam=$r['tgl_spk'];
    	$rcp=$r['rcp_spk'];
    	ECHO "Reprint SPK";
    	echo bar128(stripslashes($no_nota));
       echo "<table width=100%>
          <tr>
          <td>
          <font size=2>Nama :
          </td>        
          <td> : <font size=2>$r[nama_customer]</font></td>
          </tr>
          <tr><td>
         <font size=2> No Nota</font></td>        
          <td> : <font size=2>$no_nota</font></td>
          </tr>
          </table>
          ";
$sql2=mysqli_query($con,"SELECT * FROM detail_spk WHERE no_nota= '$no_nota'");
  echo "<table>
        <tr>
        <th></th>
        <th></th>
        </tr>";
  
  while($s=mysqli_fetch_array($sql2)){
    	
    echo "<tr>
    <td><font size=2>$s[jenis_item] </font></td>
    <td><font size=2>$s[jumlah] </font></td>
    </tr>";
  }   
$sql3=mysqli_query($con,"SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota= '$no_nota'");
$s1=mysqli_fetch_array($sql3);
echo "<div class='post_title'></div>
	  <table>
	  <tr>
	  <td><font size=2>Total</font></td>
	  <td><font size=2> $s1[total]</font><b></b>
	  </td> 
	  </tr>   
      </table>
      <tr><td col>
      <br/>
	<font size=2>Tgl $jam			Rcp :$rcp</td></tr> </font>";

  
?>