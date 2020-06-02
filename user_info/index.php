<?php 

function get_userIp(){
	if(isset($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}

$user_ip = get_userIp();

$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$user_ip));
echo $user_ip.'<br>';
echo $geo['geoplugin_city'].'<br>';
echo $geo['geoplugin_regionName'].'<br>';
echo $geo['geoplugin_countryName'].'<br>';
echo $geo['geoplugin_latitude'].'<br>';
echo $geo['geoplugin_longitude'].'<br>';


?>