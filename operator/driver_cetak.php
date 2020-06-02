<?php 
include '../config.php';

$driver = $_GET['driver'];
$ws = $_GET['workshop'];
date_default_timezone_set('Asia/Makassar');
$tgl = date('l, d F Y H:i');

echo '
<body onload="window.print()">
	<table>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td>'.$driver.'</td>
		</tr>
		<tr>
			<td>Checkin</td>
			<td>:</td>
			<td>'.$ws.'</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Tanggal</td>
			<td style="vertical-align: top">:</td>
			<td style="vertical-align: top">'.$tgl.'</td>
		</tr>
	</table>
	
	</table>
	<br>
	<table align="center">
		<tr>
			<th>Nota belum tercheckin</th>
		</tr>
';

$sql = $con->query("SELECT no_nota FROM manifest a, man_serah b WHERE a.kd_serah=b.kode_serah AND a.kd_terima='' AND b.driver='$driver' AND DATE(b.tgl)>='2019-03-01'");
while($data = $sql->fetch_array()){
	echo '
	
		<tr>
			<td style="text-align: center">XXXXXXX'.substr($data[0], 7, 10).'</td>			
		</tr>
	
	';
	
}
echo'

	</table>
</body>';

?>
