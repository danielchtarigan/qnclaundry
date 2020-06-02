<?php 

include 'config.php';

$no_order = $_POST['no_order'];

$sql = $con-> query("SELECT * FROM reception WHERE no_nota='$no_order'");
$data = $sql-> fetch_array();

if(mysqli_num_rows($sql)==null){
	echo "<span style='color:red'>Nomor order tidak ditemukan..</span>";
} 
else {



?>

<link rel="stylesheet" type="text/css" href="accounting/bootstrap/css/bootstrap.min.css">


<div id="contain">
	<h4 align="center" style="font-size: 11pt"><strong>Order Masuk</strong></h4>
	<div align="center">
		<table class="rincian1">
			<tr>
				<td>Tanggal Order :</td>
				<td>Penerima :</td>
				<td>Lokasi :</td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?= date('d/m/Y H:i:s', strtotime($data['tgl_input'])) ?></td>
				<td style="font-weight: bold;"><?= $data['nama_reception'] ?></td>
				<td style="font-weight: bold;"><?= $data['nama_outlet'] ?></td>
			</tr>
		</table>
	</div>

	<h4 align="center" style="font-size: 11pt"><strong>Pencucian</strong></h4>
	<div align="center">
		<table class="rincian1">
			<tr>
				<td>Tanggal Cuci :</td>
				<td>Operator :</td>
				<td>Lokasi :</td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php if($data['cuci']==1) echo date('d/m/Y H:i:s', strtotime($data['tgl_cuci'])); else echo "-"; ?></td>
				<td style="font-weight: bold;"><?php if($data['cuci']==1) echo $data['op_cuci']; else echo "-" ?></td>
				<td style="font-weight: bold;"><?php if($data['cuci']==1) echo $data['workshop']; else echo "-" ?></td>
			</tr>
		</table>
	</div>

	<h4 align="center" style="font-size: 11pt"><strong>Setrika</strong></h4>
	<div align="center">
		<table class="rincian1">
			<tr>
				<td>Tanggal Setrika :</td>
				<td>Setrika :</td>
				<td>Lokasi :</td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php if($data['setrika']==1) echo date('d/m/Y H:i:s', strtotime($data['tgl_setrika'])); else echo "-"; ?></td>
				<td style="font-weight: bold;"><?php if($data['setrika']==1) echo $data['user_setrika']; else echo "-" ?></td>
				<td style="font-weight: bold;"><?php if($data['setrika']==1) echo $data['workshop']; else echo "-" ?></td>
			</tr>
		</table>
	</div>

	<h4 align="center" style="font-size: 11pt"><strong>Pengemasan</strong></h4>
	<div align="center">
		<table class="rincian1">
			<tr>
				<td>Tanggal Pengemasan :</td>
				<td>Pengemas :</td>
				<td>Lokasi :</td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php if($data['packing']==1) echo date('d/m/Y H:i:s', strtotime($data['tgl_packing'])); else echo "-"; ?></td>
				<td style="font-weight: bold;"><?php if($data['packing']==1) echo $data['user_packing']; else echo "-" ?></td>
				<td style="font-weight: bold;"><?php if($data['packing']==1) echo $data['workshop']; else echo "-" ?></td>
			</tr>
		</table>
	</div>

	<h4 align="center" style="font-size: 11pt"><strong>Kembali ke Outlet</strong></h4>
	<div align="center">
		<table class="rincian1">
			<tr>
				<td>Tanggal Kembali :</td>
				<td>Penerima :</td>
				<td>Lokasi :</td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php if($data['kembali']==1) echo date('d/m/Y H:i:s', strtotime($data['tgl_kembali'])); else echo "-"; ?></td>
				<td style="font-weight: bold;"><?php if($data['kembali']==1) echo $data['reception_kembali']; else echo "-" ?></td>
				<td style="font-weight: bold;"><?php if($data['kembali']==1) echo $data['nama_outlet']; else echo "-" ?></td>
			</tr>
		</table>
	</div>
</div>

	
<?php 
}
?>
	


<style type="text/css">
	.rincian1{
		border: 2px inset;
		font : 10pt arial;
		background-color: #EEFDD7;
		height: 26px;
		width: 360px;
		margin-bottom: 15px;
	}
	
	/*td{*/
	/*	padding: 3px;*/
	/*}*/

	/*#contain {
		text-align: center;
		background-color: #f1f9e4;
		width: auto;
	}*/

</style>

