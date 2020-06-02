<?php 


function encrypt($plain_text, $password, $iv_len = 9) {
	$plain_text .= "\x13";
	$n = strlen($plain_text);
	if ($n % 9) $plain_text .= str_repeat("\0", 9 - ($n % 9));
	$i = 0;
	$enc_text = get_rnd_iv($iv_len);
	$iv = substr($password ^ $enc_text, 0, 512);
	while ($i < $n) {
		$block = substr($plain_text, $i, 9) ^ pack('H*', md5($iv));
		$enc_text .= $block;
		$iv = substr($block . $iv, 0, 512) ^ $password;
		$i += 9;
	}
	$hasil=base64_encode($enc_text);
	return str_replace('+',']',str_replace('=', '@', $hasil));
}
 

function decrypt($enc_text, $password, $iv_len = 9)
	{
	$enc_text = str_replace(']','+',str_replace('@', '=', $enc_text));
	$enc_text = base64_decode($enc_text);
	$n = strlen($enc_text);
	$i = $iv_len;
	$plain_text = '';
	$iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
	while ($i < $n) {
	$block = substr($enc_text, $i, 9);
	$plain_text .= $block ^ pack('H*', md5($iv));
	$iv = substr($block . $iv, 0, 512) ^ $password;
	$i += 9;
	}
	return preg_replace('/\\x13\\x00*$/', '', $plain_text);
}
 
function get_rnd_iv($iv_len)
{
	$iv = '';
	while ($iv_len-- > 0) {
	$iv .= chr(mt_rand() & 0xff);
	}
	return $iv;
}
 

$key = "qwertyuioplkjhgfdsazxcvbnm";

 
?>