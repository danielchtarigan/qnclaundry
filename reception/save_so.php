<?php 
include '../config.php';
		session_start();
		date_default_timezone_set('Asia/Makassar');
	  
       $us=$_SESSION['user_id'];
       $ot=$_SESSION['nama_outlet'];


	$jam=date("Y-m-d H:i:s");
	$jam2=date("Y-m-d");
	
	$nomer=$jam2 . ','.$us;

$no_nota = explode("\n", $_POST["no_nota"]);
  foreach($no_nota as $key => $value){
  	$q=mysqli_query($con,"insert into detail_so (tgl_so,outlet,no_nota,rcp_so,nomer) VALUES('$jam','$ot','$value','$us','$nomer')");
  	$q2=mysqli_query($con,"update reception set tgl_so='$jam',rcp_so='$us'  WHERE no_nota = '$value'");
  }
	 if($q){
	
	?>
	<script language="javascript">
		function Clickheretoprint()
		{
			var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
			newWindow.document.write(document.getElementById("bayarr").innerHTML);
			newWindow.print();
		}
	</script>
	<a id="cccc" href="javascript:Clickheretoprint()">
		Print
	</a>
	<div class="bayarr" id="bayarr" >
	Daftar Hilang
	<table id="rinciancuci" class="display" style="font-size: 8px;font-family: arial;" >
		<thead>
		<tr>
			<th>tgl</th>
			<th>no nota</th>
			<th>nama</th>
			<th>jumlah</th>
			<th>tgl so</th>
		</tr>
		</thead>
		<tbody>
	
<?php	
$brg=mysqli_query($con,  "SELECT DATE_FORMAT(tgl_input, '%d.%m') as tgl_input,DATE_FORMAT(tgl_so, '%d.%m') as tgl_so,no_nota,total_bayar,nama_customer FROM reception WHERE ambil=false  and kembali=true and DATE_FORMAT(tgl_so, '%Y-%m-%d')<>'$jam2' and nama_outlet='$ot' and DATE_FORMAT(tgl_input, '%Y-%m-%d')>='2015-07-01' ");
	while($data = mysqli_fetch_array($brg)){
	echo "<tr>
						<td>$data[tgl_input]</td>
						
						<td>$data[no_nota]</td>
						<td>$data[nama_customer]</td>
						<td>$data[total_bayar]</td>
						<td>$data[tgl_so]</td>
						
						
						 </tr>";
						 }
	
	 ?>
	 </tbody>
	</table>

	 </div>
<?php
}
	else {
	 echo '<font color="red">Error, Data Tidak Tersimpan</font>';
	 }


?>
