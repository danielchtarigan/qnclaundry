<?php 
include '../config.php';

$sql = $con->query("SELECT reception.tgl_spk AS tgl_spk, reception.no_nota AS no_nota, detail_penjualan.item AS item, (detail_penjualan.harga*detail_penjualan.jumlah) AS total, item_spk.kategory AS kategory, reception.rcp_spk AS rcp_spk FROM ((reception INNER JOIN detail_penjualan ON reception.no_nota=detail_penjualan.no_nota) INNER JOIN item_spk ON detail_penjualan.item=item_spk.nama_item) WHERE reception.nama_outlet<>'mojokerto' AND reception.jenis='p' AND item_spk.kategory<>'' AND DATE_FORMAT(reception.tgl_spk, '%Y-%m-%d') BETWEEN '2018-03-26' AND '2018-04-25' GROUP BY tgl_spk,no_nota,item ORDER BY tgl_spk");

?>

<table>
	<thead>
		<tr>
			<th>Tanggal SPK</th>
			<th>No Nota</th>
			<th>Item SPK</th>
			<th>Harga</th>
			<th>Kategory SPK</th>
			<th>DiSPK Oleh</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		while($data = $sql->fetch_array()){
			?>
			<tr>
				<td><?= $data['tgl_spk'] ?></td>
				<td><?= $data['no_nota'] ?></td>
				<td><?= $data['item'] ?></td>
				<td><?= $data['total'] ?></td>
				<td><?= $data['kategory'] ?></td>
				<td><?= $data['rcp_spk'] ?></td>
			</tr>

			<?php
		}
		?>
	</tbody>
</table>