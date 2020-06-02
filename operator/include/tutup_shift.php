
<h3>Tutup Shift Operator</h3><br>
<form action="act/tutup_shift.php" method="POST">
	<strong>Mesin Cuci Bisa Dipakai</strong>
	<table>
		<tr>
			<td>Mesin Cuci Kecil</td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
			<td>:</td>
			<td><input class="form-control" type="number" name="mesin_cuci_kecil" value="0"></td>
		</tr>
		<tr>
			<td>Mesin Cuci Besar</td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
			<td>:</td>
			<td><input class="form-control" type="number" name="mesin_cuci_besar" value="0"></td>
		</tr>		
	</table><br>
	<strong>Mesin Pengering Bisa Dipakai</strong>
	<table>
		<tr>
			<td>Mesin Pengering Kecil</td>
			<td>:</td>
			<td><input class="form-control" type="number" name="mesin_pengering_kecil" value="0"></td>
		</tr>
		<tr>
			<td>Mesin Pengering Besar</td>
			<td>:</td>
			<td><input class="form-control" type="number" name="mesin_pengering_besar" value="0"></td>
		</tr>		 
	</table><br>

	<table>
		<tr>
			<td>Keterangan</td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
			<td>:</td>
			<td><textarea class="form-control" name="ket" cols="22"></textarea></td>
		</tr>
	</table>
	<button name="kirim" class="btn btn-md">Simpan</button>
</form>