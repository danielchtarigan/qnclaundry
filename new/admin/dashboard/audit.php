<?php 

$date = date('Y-m-d', strtotime('-7 day', strtotime(date('Y-m-d'))));
$date2 = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

$day = date('l', strtotime('-7 day', strtotime(date('Y-m-d'))));
$day2 = date('l', strtotime('-1 day', strtotime(date('Y-m-d'))));

switch ($day){
	case "Sunday" : $hari = "Minggu"; break;
	case "Monday" : $hari = "Senin"; break;
	case "Tuesday" : $hari = "Selasa"; break;
	case "Wednesday" : $hari = "Rabu"; break;
	case "Thursday" : $hari = "Kamis"; break;
	case "Friday" : $hari = "Jumat"; break;
	case "Saturday" : $hari = "Sabtu"; break;
}

switch ($day2){
	case "Sunday" : $hari2 = "Minggu"; break;
	case "Monday" : $hari2 = "Senin"; break;
	case "Tuesday" : $hari2 = "Selasa"; break;
	case "Wednesday" : $hari2 = "Rabu"; break;
	case "Thursday" : $hari2 = "Kamis"; break;
	case "Friday" : $hari2 = "Jumat"; break;
	case "Saturday" : $hari2 = "Sabtu"; break;
}


$smp = mysqli_query($con, "SELECT *FROM quality_audit AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota where DATE_FORMAT(a.tgl_input, '%Y-%m-%d') between '$date' and '$date2' AND b.nama_outlet='$_SESSION[outlet]'");
$sampel = mysqli_num_rows($smp);
if ($sampel>0) {
	$sampel = mysqli_num_rows($smp);
	$s = $sampel;
}else{
	$sampel = 1;
	$s = 0;
}

$query = mysqli_query($con, "SELECT sum(a.bersih) as bersih FROM quality_audit AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota where DATE_FORMAT(a.tgl_input, '%Y-%m-%d') between '$date' and '$date2' AND b.nama_outlet='$_SESSION[outlet]'");
	$hasilb = mysqli_fetch_array($query);
	$bersih = $hasilb['bersih'];
	$b = ($bersih/$sampel);
	
$query2 = mysqli_query($con, "SELECT sum(a.rapi) as rapi FROM quality_audit AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota where DATE_FORMAT(a.tgl_input, '%Y-%m-%d') between '$date' and '$date2' AND b.nama_outlet='$_SESSION[outlet]'");
	$hasilc = mysqli_fetch_array($query2);
	$rapi = $hasilc['rapi'];
	$c = ($rapi/$sampel);
	

$query3 = mysqli_query($con, "SELECT sum(a.harum) as harum FROM quality_audit AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota where DATE_FORMAT(a.tgl_input, '%Y-%m-%d') between '$date' and '$date2' AND b.nama_outlet='$_SESSION[outlet]'");
	$hasild = mysqli_fetch_array($query3);
	$harum = $hasild['harum'];
	$d = ($harum/$sampel);

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="columnchart_values" style="width: 100%; min-height: 200px;"></div>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
      var data = google.visualization.arrayToDataTable([
        ["Kategori", "Rat", { role: "style" } ],
        ["Kebersihan", <?php echo $b ?>, "#76ec64"],
        ["Kerapian", <?php echo $c ?>, "#bdd2ec"],
        ["Keharuman", <?php echo $d ?>, "#ce7cec"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Quality Audit",
        bar: {groupWidth: "100%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }

	  $(window).resize(function(){
	  	drawChart3();
	  });
	
</script>

<?php echo '<p style="font-size: 10px; font-weight: bold; text-align: right;">Skala : ' .$hari.', '.date('d M Y', strtotime('-7 day', strtotime(date('Y-m-d')))).' - '.$hari2.', '.date('d M Y', strtotime('-1 day', strtotime(date('Y-m-d')))).'<br>Jumlah sampel : '.$s.'</p>'; ?>


	

