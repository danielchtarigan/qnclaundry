<?php 

include '../function_tutup_shift.php';



echo 
'
<body onload="window.print()">
<br>
<strong>
Nomor : '.$nomor.'
<br><br>
'.strtoupper($userId).'
<br>
'.$outlet.'
<br>
'.date('l, d F Y', strtotime($nowDate)).' '.date('H:i').'
</strong>
<hr>
<b>Pendapatan Order Laundry</b>
<table class="table">
	<tr>
		<td width="60%">Cash</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'Cash',$nowDate)).'</td>
	</tr>
	<tr>
		<td>BNI</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'BNI',$nowDate)).'</td>
	</tr>
	<tr>
		<td>BRI</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'BRI',$nowDate)).'</td>
	</tr>
	<tr>
		<td>BCA</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'BCA',$nowDate)).'</td>
	</tr>
	<tr>
		<td>Mandiri</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'Mandiri',$nowDate)).'</td>
	</tr>
	<tr>
		<td>Kuota</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'Kuota',$nowDate)).'</td>
	</tr>
	<tr>
		<td>Cashback</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'Cashback',$nowDate)).'</td>
	</tr>
	<tr>
		<td>Piutang</td>
		<td>:</td>
		<td>'.rupiah(belum_lunas($userId,$nowDate)).'</td>
	</tr>
</table>

<br>
<b>Pendapatan Membership</b>
<table class="table">
	<tr>
		<td width="60%">Cash</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'Cash',$nowDate,'membership')).'</td>
	</tr>
	<tr>
		<td>BNI</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'BNI',$nowDate,'membership')).'</td>
	</tr>
	<tr>
		<td>BRI</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'BRI',$nowDate,'membership')).'</td>
	</tr>
	<tr>
		<td>BCA</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'BCA',$nowDate,'membership')).'</td>
	</tr>
	<tr>
		<td>Mandiri</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'Mandiri',$nowDate,'membership')).'</td>
	</tr>
</table>
<br>

<b>Pendapatan Deposit Berlangganan</b>
<table class="table">
	<tr>
		<td width="60%">Cash</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'Cash',$nowDate,'deposit')).'</td>
	</tr>
	<tr>
		<td>BNI</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'BNI',$nowDate,'deposit')).'</td>
	</tr>
	<tr>
		<td>BRI</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'BRI',$nowDate,'deposit')).'</td>
	</tr>
	<tr>
		<td>BCA</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'BCA',$nowDate,'deposit')).'</td>
	</tr>
	<tr>
		<td>Mandiri</td>
		<td>:</td>
		<td>'.rupiah(berlangganan_bayar($userId,'Mandiri',$nowDate,'deposit')).'</td>
	</tr>
</table>
<br>

<b>Pendapatan Delivery</b>
<table class="table"">
	<tr>
		<td width="60%">Cash</td>
		<td>:</td>
		<td>'.rupiah(order_bayar_delivery($userId,'Cash',$nowDate,'Delivery')).'</td>
	</tr>
	<tr>
		<td width="60%">Kuota</td>
		<td>:</td>
		<td>'.rupiah(order_bayar_delivery($userId,'Kuota',$nowDate,'Delivery')).'</td>
	</tr>
</table>
<p style="border: 1px dashed;"></p>

<h3>TOTAL PENDAPATAN</h3>
<table class="table">
	<tr>
		<td width="60%">Cash</td>
		<td>:</td>
		<td>'.rupiah($cash).'</td>
	</tr>
	<tr>
		<td>BNI</td>
		<td>:</td>
		<td>'.rupiah($bni).'</td>
	</tr>
	<tr>
		<td>BRI</td>
		<td>:</td>
		<td>'.rupiah($bri).'</td>
	</tr>
	<tr>
		<td>BCA</td>
		<td>:</td>
		<td>'.rupiah($bca).'</td>
	</tr>
	<tr>
		<td>Mandiri</td>
		<td>:</td>
		<td>'.rupiah($mandiri).'</td>
	</tr>
	<tr>
		<td>Kuota</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'Kuota',$nowDate)).'</td>
	</tr>
	<tr>
		<td>Cashback</td>
		<td>:</td>
		<td>'.rupiah(order_bayar($userId,'Cashback',$nowDate)).'</td>
	</tr>
	<tr>
		<td>Piutang</td>
		<td>:</td>
		<td>'.rupiah(belum_lunas($userId,$nowDate)).'</td>
	</tr>
</table>
<p style="border: 1px dashed;"></p>

<table style="margin-top: 25px">
	<tr>
		<td colspan="3">Catatan :</td>
	</tr>
</table>
<table>
	<tr>
		<td></td>
		<td colspan="2" width="90%">Setor struk ini beserta dengan Uang kas, Settlment, dan Voucher fisik ke Staff Akunting setiap hari penyetoran</td>
	</tr>
</table>

</body>
';

?>


