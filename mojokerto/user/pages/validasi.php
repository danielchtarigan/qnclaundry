<?php
function val_session() {
	$cek = 0;
	if ( !empty($_SESSION['level']) ) {
		$cek = $cek + 1;
	}
	if ( !empty($_SESSION['name']) ) {
		$cek = $cek + 1;
	}
	if ( !empty($_SESSION['nama_outlet']) ) {
		$cek = $cek + 1;
	}
	
	return $cek;
}