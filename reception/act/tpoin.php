<?php 
session_start();
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];
?>
<?php
include "../../config.php";

	
	
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
	$tgl_join=date("Y-m-d");
	
	$id_cs=$_GET['id_cs'];	
	$poin=$_GET['sisapoin'];
	$hadiah=$_GET['hadiah'];
	
	if($poin>=0){

	
	$cs=mysqli_query($con,"update customer set poin='$poin' WHERE  id='$id_cs'");	
	
	if($cs)
    
    {    	   

?>
<script language="javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("mb").innerHTML);
    newWindow.print(); 
}
</script>
<body onload="print()">
<div class="mb" id="mb">   
<div style="font-size: 12px; font-family: Arial" >
<div align="center"><img src="../../logo.bmp" ></div>

<div align="center">Quick &' Clean Laundry</div>
<div align="center">Jl Toddopuli Raya No 08</div>
<div align="center">Makassar</div>
<div align="center">0411-444180</div>
<div align="center" class="style1 style4">Penukaran Poin</div>

<div align="center"><?php
// echo 'Nama : '.$r['id_customer'].'<br>';
echo 'Hadiah <br>';
?>
</div>
<div align="center">
<table id="resultTable" data-responsive="table" style="text-align: center;">
	<thead>
		<tr>
			
			<th></th>
			
		</tr>
	</thead>
	<tbody>	
				<tr>				
						<td colspan="4"><?php echo $hadiah;?></td>				
				</tr>			
				
				<tr>								
			</tr>
			<tr>
				<td colspan="2">Sisa Poin:</td><td></td>
				<td colspan="4">
				<?php
				$pn=mysqli_query($con, "select *from customer where id='$id_cs'");
				while($sisapn=mysqli_fetch_assoc($pn)){
					echo $sisapn['poin'] ;
				}
				?>
				</td>
			</tr>				
	</tbody>
</table>
</div>
</div>
<div align="center">
<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[user_id]" ?>
</div>
<div align="center">
    <br/ >
								Customer<br/> </br> </br>
								<br/>(<?php
								 $edit = mysqli_query($con,"SELECT nama_customer FROM customer WHERE id='$id_cs'");
	    						$r    = mysqli_fetch_array($edit);
								 echo $r['nama_customer'] ?>)
	
</div>
</div>
<?php
}
else
{  echo "ERROR"; }
?>
</body>
<?php
	}
else{
	echo 'Poin Belum Mencukupi';
}
	