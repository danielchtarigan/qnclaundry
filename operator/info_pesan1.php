<?php
session_start();
date_default_timezone_set('Asia/Makassar');
$tanggal = date('d F Y');

?>

<div id="popup" data-dismiss="alert">
    <div id="info3">
      <button type="button" class="tombol-close" aria-label="Close" title="Tutup"><span aria-hidden="true">&times;</span></button> 
      <table>
      	<tr>
      		<th id="date"></th>
      		<th>&nbsp; | &nbsp;</th>
      		<th>Workshop <?= $_SESSION['workshop'] ?></th>
      	</tr>
      	<tr>
      		<th id="clock" style="text-align: right"></th>
      		<th>&nbsp; | &nbsp;</th>
      		<th><?= ucfirst($_SESSION['user_id']).' (Operator)' ?></th>
      	</tr>
      </table> 
      <br>
      
     <strong>Penting!</strong> Jawab Teka-Teki berhadiah pulsa Rp 50.000
     <br><br>
     <p>Apa itu S2B(j.l.potongan)?</p>
     <p>Chat ke WA 085396478393</p>
     
    </div>
</div>

<script>
	 
function startTime() {
    var today = new Date();
    setTimeout("startTime()", 1000);
    var tgl = today.getDate();
    var bln = today.getMonth();
    var thn = today.getFullYear();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    //Add a zero in front of numbers<10
    tgl = checkTime(tgl);
    bln = checkTime(bln);
    hr 	= checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("date").innerHTML = tgl+"/"+bln+"/"+thn;
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec;
    
}
var time = setTimeout(function(){ startTime() }, 100);

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

</script>
