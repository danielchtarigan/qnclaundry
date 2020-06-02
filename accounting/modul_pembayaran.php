<?php 
include 'config.php';
include 'akses.php';


$query = mysqli_query($con, "SELECT * FROM pemesanan WHERE no_nota='$_GET[id]'");
$row = mysqli_fetch_assoc($query);
$total = $row['harga']*$row['quantity'];

$qfaktur = mysqli_query($con, "SELECT MAX(no_faktur) AS no_faktur FROM pemesanan");
$faktur = mysqli_fetch_row($qfaktur);
$lasturut = (int)substr($faktur[0], 5, 6);
$no_faktur = "FS".sprintf('%08s', $lasturut+1);

?>

<form action="action/bayar_tagihan.php" method="POST">
	<input class="hidden" type="text" name="id" value="<?php echo $_GET['id'] ?>">
	<table style="font-family: arial; padding: 100px; margin: 25px; width: 90% ">
		<tr>
			<th width="60%" style="text-align: left">No Faktur</th>
			<td> : &nbsp;</td>
			<td style="font-weight: bold"><input class="form-control" type="text" name="no_faktur" value="<?php echo $no_faktur ?>" readonly></td>
		</tr>
		<tr>
			<th width="60%" style="text-align: left">Total Tagihan</th>
			<td> : &nbsp;</td>
			<td style="font-weight: bold"><input class="form-control" type="text" name="total" value="<?php echo $total ?>" readonly></td>
		</tr>
		<tr>
			<td width="60%" style="text-align: left">Nama Item</td>
			<td> : &nbsp;</td>
			<td><input class="form-control" type="text" name="item" value="<?php echo $row['nama_item'] ?>" readonly></td>
		</tr>
		<tr>
			<td width="60%" style="text-align: left">Nama Supplier</td>
			<td> : &nbsp;</td>
			<td><input class="form-control" type="text" name="supplier" value="<?php echo $row['nama_supplier'] ?>" readonly></td>
		</tr>
		<tr>
			<td>Pembayaran</td>
			<td>: &nbsp;</td>
			<td>
				<select class="form-control" name="cara_bayar">
					<option>--Pilih Cara Bayar--</option>
					<option>Cash</option>
					<option>Transfer Banking</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
			<input type="submit" class="btn btn-success" name="simpan" value="Bayar" style="width: 100%">
			</td>
		</tr>

	</table>
</form>
	
