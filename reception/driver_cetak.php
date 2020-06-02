<?php 
include '../config.php';

$driver = $_GET['driver'];
$ot = $_GET['outlet'];
date_default_timezone_set('Asia/Makassar');
$tgl = date('l, d F Y H:i');

echo '
<body onload="window.print()">
    <h3 align="center">Yang discan itu adalah Nota dicucian!!!</h3>
	<table>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td>'.$driver.'</td>
		</tr>
		<tr>
			<td>Outlet</td>
			<td>:</td>
			<td>'.$ot.'</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Tanggal</td>
			<td style="vertical-align: top">:</td>
			<td style="vertical-align: top">'.$tgl.'</td>
		</tr>
		<tr>
			<td style="vertical-align: top">Jumlah</td>
			<td style="vertical-align: top">:</td>
			<td style="vertical-align: top">';
			$sql = $con->query("SELECT no_nota FROM manifest a, (SELECT kode_serah FROM man_serah WHERE driver='$driver' AND tempat='$ot' ORDER BY tgl DESC LIMIT 0,1) b WHERE a.kd_serah=b.kode_serah");
            echo mysqli_num_rows($sql).'
			</td>
		</tr>
	</table>
</body>';

?>
