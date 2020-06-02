<?php


$rj = $con-> query("SELECT * FROM reception WHERE nama_outlet='$outlet' AND rijeck=true");
$cc = mysqli_num_rows($rj);

?>
<script type="text/javascript">
function startTime() {
	var cc = '<?= $cc ?>';

	if(cc>0){
		location.href='#pr';
	}   	

}

setInterval(startTime, 500);
</script>

<div id="pr">
	<div id="info">
 		
 		<?php include 'include/info-pesan.php' ?>

	</div>
</div>

