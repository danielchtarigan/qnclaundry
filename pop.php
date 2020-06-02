<?php
date_default_timezone_set('Asia/Makassar');
$ot = $_SESSION['nama_outlet'];
$tgl = date('Y-m-d');

$sql = mysqli_query($con, "SELECT * FROM poptime ORDER BY nama DESC limit 21");

 
?>
<script type="text/javascript">
function startTime() {
    var today=new Date(),
    curr_hour=today.getHours(),
    curr_min=today.getMinutes(),
    curr_sec=today.getSeconds();
	curr_hour=checkTime(curr_hour);
    curr_min=checkTime(curr_min);
    curr_sec=checkTime(curr_sec);
    document.getElementById('clock').innerHTML=curr_hour+":"+curr_min+":"+curr_sec;
    <?php
														
		$query = "SELECT * FROM poptime ORDER BY id DESC limit 21" ;
		$tampil = mysqli_query($con, $query);
		while($data = mysqli_fetch_array($tampil)){
		$waktu=$data['time'];
		$jam=substr($waktu, 11,2);
		$menit=substr($waktu, 14,2);
		$detik=substr($waktu, 17,2);
	?>
	if (curr_hour=='<?php echo $jam; ?>' && curr_min=='<?php echo $menit; ?>' && curr_sec=='<?php echo $detik; ?>'){
		location.href='#popup100';
		}
	<?php
		}
	?>
}
function checkTime(i) {
    if (i<10) {
        i="0" + i;
    }
    return i;
}
setInterval(startTime, 500);
</script>

<div id="popup100">
<div style="background-color:#6C3;" id="kolom">
<p align="center"> <strong> POPUP Window!! </strong> </p>
<div id="clock"></div>
                                        <div>
                                            <div class="col-xs-14" >
											<form id="formpopup" name="formpopup" method="POST" action="savepop.php">
												Copy code ini ke QnC Key Generator yang terinstall di komputer anda!<br>
												<table style="width:95%; margin:10px;">
												<tr>
													<td>Challenge Code : </td><td><input type="text" id="key100" name="key100" class="form-control" placeholder="0" value="<?php echo "K".rand(111,999)."QnC".rand(11111,99999);?>" readonly>		
											    </td>
												</tr>
                                                <tr><td colspan="2"><input type="text" id="code100" name="code100" class="form-control" placeholder="Respon Code" required></td></tr>
                                                <tr><td colspan="2"><input type="submit" value="Simpan" /></td></tr>
                                                </table>										                                            </form>
											</div>											     
		                              </div>
</div>
</div>



<style>
#popup100 {
		visibility: hidden;
		opacity: 0;
		margin-top: -180px;
	}
	#kolom:target {
		padding:40px;
	}

	#popup100:target {
		visibility:visible;
		opacity: 1;
		background-color: rgba(255,255,255,0.8);
		position: fixed;
		top:0px;
		left:0px;
		right:0;
		bottom:0;
		margin:0;
		padding-top:150;
		padding-left:430;
		padding-right:430;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;			
	}
</style>