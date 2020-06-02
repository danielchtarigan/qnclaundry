<?php

function masaBerlaku($tgl_sekarang,$tgl_selesai) {
	$tgl_sekarang = strtotime($tgl_sekarang);
	$tgl_selesai = strtotime($tgl_selesai);
	
	if ( $tgl_sekarang > $tgl_selesai ){
		return $status = "0";
	}else {
		return $status = "1";
		}
}


?>