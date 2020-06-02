<html>
<head>
<?php 
require "header.php";
include "../config.php"; 
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

?>
</head>
<body>
<div  class="container-fluid" style="width:500px;
   margin:0 auto; 
   position:relative; 
   border:3px solid rgba(0,0,0,0); 
   -webkit-border-radius:5px; 
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
 <fieldset>
<legend align="center"><strong>BELUM SPK Lunas</strong></legend> 
	<table id="belumkembali" class="display">
		<thead>
		<tr>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Aksi</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT id, tgl_input,no_nota,nama_customer,lunas FROM reception where nama_outlet='$ot' and ambil=false and kembali=false and spk=false and lunas=true and (CABANG <>'sub-pendidikan' or CABANG='sub-tello' or CABANG <>'sub-Tamangapa' or CABANG='sub-abdesir' or CABANG <>'sub-jappa' or CABANG='sub-manggarupi' or CABANG <>'sub-h.bau' or CABANG='sub-alaudin' or cabang<>'sub-perintis' ) ORDER BY tgl_input DESC" ;
			$tampil = mysqli_query($con, $query);
				while($data = mysqli_fetch_array($tampil)){
					
					?>
				
				<tr id="<?php echo $data['id']; ?>">
				
				<td>
				<?php echo $data['tgl_input']; ?></td>
				<td><?php echo $data['no_nota']; ?></td>
				<td><?php echo $data['nama_customer']; ?></td>
				<td align="center">
			
				<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="detail_spk.php?id=<?php echo $data['id']; ?>">pilih</a>
				</td>
				</tr>
				<?php } 
				?>
		</tbody>
	</table>





</fieldset>
<fieldset>
<legend align="center"><strong>BELUM SPK sub agen</strong></legend> 
	<table id="subagen" class="display">
		<thead>
		<tr>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Nama Customer</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT id, tgl_input,no_nota,nama_customer,lunas FROM reception where nama_outlet='$ot' and ambil=false and packing=false and kembali=false and spk=false and cuci=false and setrika=false and (CABANG ='sub-pendidikan' or CABANG='sub-tello' or CABANG ='sub-Tamangapa' or CABANG='sub-abdesir' or CABANG ='sub-jappa' or CABANG='sub-manggarupi' or CABANG ='sub-h.bau' or CABANG='sub-alaudin' or cabang = 'sub-perintis' or cabang = 'hvenus' or cabang = 'hastra' or cabang = 'hcontinent' or cabang = 'hvindikap') ORDER BY tgl_input DESC" ;
			$tampil = mysqli_query($con, $query);
				while($data = mysqli_fetch_array($tampil)){
					
					?>
				
				<tr id="<?php echo $data['id']; ?>">
				
				<td>
				<?php echo $data['tgl_input']; ?></td>
				<td><?php echo $data['no_nota']; ?></td>
				<td><?php echo $data['nama_customer']; ?></td>
				<td align="center">
			
				<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="detail_spk.php?id=<?php echo $data['id']; ?>">pilih</a>
				</td>
				</tr>
				<?php } 
				?>
		</tbody>
	</table>





</fieldset>
<fieldset>
<legend align="center"><strong>BELUM di SPK belum lunas</strong></legend> 
	<table id="belumspk" class="display">
		<thead>
		<tr>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
<th>Rcp</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT id, tgl_input,no_nota,nama_customer,lunas,nama_reception FROM reception where nama_outlet='$ot' and ambil=false and packing=false and kembali=false and spk=false and cuci=false and lunas=false ORDER BY tgl_input DESC" ;
			$tampil = mysqli_query($con, $query);
				while($data = mysqli_fetch_array($tampil)){
					
					?>
				
				<tr">
			
				<td>
				<?php echo $data['tgl_input']; ?></td>
				<td><?php echo $data['no_nota']; ?></td>
				<td><?php echo $data['nama_customer']; ?></td>
<td><?php echo $data['nama_reception']; ?></td>
				</tr>
				<?php } 
				?>
		</tbody>
	</table>





</fieldset>
</div>

</body>

	<script type="text/javascript">
        $(function() {
            $("#no_nota").focus();
        });
    </script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#belumkembali').dataTable();
			$('#belumspk').dataTable();
$('#subagen').dataTable();

		});
		</script>
		

</html>