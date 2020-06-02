<?php 

include '../config.php';
$startDate = '2017-04-26';
$endDate = '2017-05-25';

$datauser['name'] = "DEVI SETRIKA";

$setrikaexp = mysqli_query($con, "SELECT COUNT(*) as bonus, user_setrika FROM reception WHERE user_setrika='$datauser[name]' AND (express='1' OR express='2' OR express='3') AND (DATE_FORMAT(tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltsetrikaexp = mysqli_fetch_array($setrikaexp);
$bonusop = $rsltsetrikaexp['bonus'];
		echo $bonusop;

?>