<?php

class fungsi_string {
	
	//Fungsi string untuk memotong kata atau kalimat dengan memperhatikan keutuhan kata terakhir
	function potong_string($string,$panjang) {
		$hasil = strip_tags($string);
		$hasil = substr($string,0,$panjang);
		$hasil = substr($string,0,strrpos($hasil," "));
		return $hasil." ...";
	}
	
	//Fungsi string untuk memotong kata atau kalimat tanpa memperhatikan keutuhan kata terakhir
	function potong_string2($str, $panjang) {
	  $tail = max(0, $panjang-10);
	  $potong = substr($str, 0, $tail);
	  $potong .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $panjang-$tail))));
	  return $potong;
	}
	
	//Fungsi Seo
	function seo($str){
		$str = strtolower(trim($str));
		$str = preg_replace('/[^a-z0-9-]/', '-', $str);
		$str = preg_replace('/-+/', "-", $str);
		return $str;
	}
}
?>