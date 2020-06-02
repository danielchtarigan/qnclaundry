<?php

include "config.php";

$query1 = mysqli_query($con,"SELECT DISTINCT nama_pengantar FROM delivery_harian");
while ($r = mysqli_fetch_row($query1)) {
	$nama_pengantar = $r[0];
	$query2 = mysqli_query($con,"SELECT outlet,COUNT(outlet) AS outlet_count FROM delivery_harian WHERE nama_pengantar='$nama_pengantar' GROUP BY outlet ORDER BY outlet_count DESC LIMIT 1");
	$outlet = mysqli_fetch_row($query2)[0];
	$query3 = mysqli_query($con,"SELECT latitude,longitude FROM outlet WHERE nama_outlet='$outlet'");
	$latlng = mysqli_fetch_assoc($query3);
	$outlet_lat = $latlng['latitude'];
	$outlet_lng = $latlng['longitude'];
	$query4 = mysqli_query($con,"INSERT INTO delivery_poin (nama_pengantar,poin,jumlah_delivery,tanggal) SELECT nama_pengantar,ROUND(SUM(ACOS(COS(RADIANS(90-$outlet_lat))*COS(RADIANS(90-latitude)) +SIN(RADIANS(90-$outlet_lat))*SIN(RADIANS(90-latitude))*COS(RADIANS($outlet_lng-longitude)))*6371),2), COUNT(id_delivery), NOW() FROM delivery_harian WHERE nama_pengantar='$nama_pengantar'");
}
$query5 = mysqli_query($con,"TRUNCATE TABLE delivery_harian")

?>