<body onLoad="print()">
<div style="max-width:80mm;margin:0mm;">
<?php
include '../config.php';
session_start();
	$no_nota=$_GET['no_nota'];
	$brg=mysqli_query($con,"select * from detail_spk WHERE no_nota='$no_nota'");
	$nbrg=mysqli_num_rows($brg);  
	$i=1;
    while($r=mysqli_fetch_array($brg)){
if ($i==1){
}
else{
?>
<div style="page-break-before:always;">
<?php
	}
	?>
	<table border="1" style="border-collapse:collapse; font-size:12px; height:40px;">
	<?php 
    	$tgl =  date('d M');
    	echo "<tr id='$r[id]' >
        		<td>$i/$nbrg # $r[no_nota] # $tgl # $r[no_nota] # $i/$nbrg</td>
              </tr>";
?>
</table>
<?php
if ($i==1){
}
else{
?>
</div>
<?php
}
?>
<?php
			$i++;
    }
?>
<div style="page-break-before:always;">
	<table border="1" style="border-collapse:collapse; font-size:12px; height:40px;">
     <tr><td valign="middle">Outlet</td></tr>
    </table>
</div>
<div style="page-break-before:always;">
	<table border="1" style="border-collapse:collapse; font-size:12px; height:40px;">
     <tr><td valign="middle">Outlet</td></tr>
    </table>
</div>
</div>
</body>
