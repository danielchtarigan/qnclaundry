<?php 
include '../../config.php';

$frek = $_GET['frek'];
$hari = implode(",", $_GET['hari']);
$min_tr = $_GET['min'];
$max_tr = $_GET['max'];
$startDate = $_GET['start'];
$endDate = $_GET['end'];
$jenis = $_GET['jenis'];
$jam = $_GET['jam'];

if($jenis=='A') {
	function frek_trx($startDate,$endDate,$idcs) {
		global $con,$frek,$jenis;
		$sql = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_input, '%Y/%m/%d')) AS jum FROM reception WHERE id_customer='$idcs' AND (cara_bayar<>'Void' OR cara_bayar<>'Reject') AND (DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate')");
		$data = mysqli_fetch_row($sql);
		return $data[0];
	}

	function total_trx($startDate,$endDate,$idcs) {
		global $con,$min_tr,$max_tr,$jenis;
		$sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE id_customer='$idcs' AND (cara_bayar<>'Void' OR cara_bayar<>'Reject') AND (DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate')");
		$data = mysqli_fetch_row($sql);
		return $data[0];
	}
}
else {
	function frek_trx($startDate,$endDate,$idcs) {
		global $con,$frek,$jenis;
		$sql = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_input, '%Y/%m/%d')) AS jum FROM reception WHERE id_customer='$idcs' AND (cara_bayar<>'Void' OR cara_bayar<>'Reject') AND (DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND jenis='$jenis'");
		$data = mysqli_fetch_row($sql);
		return $data[0];
	}

	function total_trx($startDate,$endDate,$idcs) {
		global $con,$min_tr,$max_tr,$jenis;
		$sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE id_customer='$idcs' AND (cara_bayar<>'Void' OR cara_bayar<>'Reject') AND (DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND jenis='$jenis'");
		$data = mysqli_fetch_row($sql);
		return $data[0];
	}
}

	

function kriteria_sms($startDate,$endDate,$idcs) {
	$data['trans'] = total_trx($startDate,$endDate,$idcs);
	$data['freks'] = frek_trx($startDate,$endDate,$idcs);

	return $data;
}

if($jenis=="A") {
	$sql = mysqli_query($con, "SELECT DISTINCT id_customer AS idcs, nama_customer AS namacs FROM reception WHERE nama_outlet<>'mojokerto' AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
} 
else {
	$sql = mysqli_query($con, "SELECT DISTINCT id_customer AS idcs, nama_customer AS namacs FROM reception WHERE jenis='$jenis' AND nama_outlet<>'mojokerto' AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
}

while($resql = mysqli_fetch_array($sql)){
	$namacs = $resql['namacs'];
	$idcs = $resql['idcs'];
	$telepons = mysqli_query($con, "SELECT no_telp FROM customer WHERE id='$idcs'");
	$telp = mysqli_fetch_row($telepons)[0];
	$awal = date('Y-m-d', strtotime($startDate));
	$akhir = date('Y-m-d', strtotime($endDate));

	$data = kriteria_sms($startDate,$endDate,$idcs);

		if($data['freks']>=$frek){
		    
		    if($data['trans']>=$min_tr || $data['trans']<=$max_tr) {
		        $data_string = rtrim($idcs,",");
    			$id_str_array = explode(",", $data_string);
    
    			foreach ($id_str_array as $key => $value) {
    				
    				$idcs = explode("-", $value);
    				$idcs = $idcs[0];
    				mysqli_query($con, "INSERT INTO siap_sms (id_customer,no_telp,jenis_item,min_transaksi,maks_transaksi,frek_kunjungan,range_awal,range_akhir,hari,jam) VALUES ('$idcs','$telp','$jenis','$min_tr','$max_tr','$frek','$startDate','$endDate','$hari','$jam') ");
		        }
		
    			
			}
						
		}			
}

$sql = mysqli_query($con, "SELECT * FROM siap_sms WHERE sent=false AND range_awal='$startDate' AND range_akhir='$endDate' AND frek_kunjungan='$frek' ");
$count = mysqli_num_rows($sql);

if($jenis=="A") $j="Semua"; else if($jenis=="k") $j="Kiloan"; else if($jenis=="p") $j="Potongan";

	
$konten = "QNCLAUNDRY
";

?>

<h4>Konten SMS Promo</h4>
<div class="alert alert-success" role="alert">Kategori : Customer dengan kunjungan <?= $frek.' kali dalam rentan '.date('d/m/Y', strtotime($startDate)).' - '.date('d/m/Y', strtotime($endDate)).' dengan transaksi '.$min_tr.' hingga '.$max_tr.' Item '.$j ?> </div>
<form class="form-horizontal" action="act/p_sms_promo.php" method="POST">
	<div class="form-group">
		<label class="col-md-2">Jumlah Kontak</label>
		<div class="col-md-4">
			<input type="text" name="" value="<?= $count ?>" class="form-control" readonly="true">
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2">Konten</label>
		<div class="col-md-4">
			<textarea id="konten" name="konten" class="form-control" rows="6" maxlength="160"><?= $konten ?></textarea><br>
			<div style="margin-top: -15px; color: green; font-size: 10px"><span id="nkonten">0</span>/160 karakter</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2"><p class="pull-left">Hari SMS</p></label>
		<div class="col-md-4">
			<?php 
			$nhari = explode(",", $hari);

			foreach ($nhari as $key => $value) {
				$chari = explode("-", $value);
				$chari = $chari[0];

				switch ($chari) {
					case 'Sunday': $hariSms = "Minggu"; break;
					case 'Monday': $hariSms = "Senin"; break;
					case 'Tuesday': $hariSms = "Selasa"; break;
					case 'Wednesday': $hariSms = "Rabu"; break;
					case 'Thursday': $hariSms = "Kamis"; break;
					case 'Friday': $hariSms = "Jumat"; break;
					case 'Saturday': $hariSms = "Sabtu"; break;
				}				

				echo '<input type="checkbox" disabled checked name="" readonly="" value="'.$chari.'">'.$hariSms.' ';
				echo '<input class="hidden" type="checkbox" readonly checked name="hari_sms" readonly="" value="'.$chari.'" id="hari">';
			}
			?>
			
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2"><p class="pull-left">Mulai Pukul</p></label>
		<div class="col-md-4">
			<input type="text" class="form-control" name="jam_sms" value="<?= $jam ?>" readonly="" id="jam">
		</div>
	</div>
	<div class="form-group">		
		<div class="col-md-4 col-md-offset-2">
			<input type="submit" class="btn btn-md btn-success" name="" value="Kirim">
			<input type="button" class="btn btn-md btn-danger pull-right batalkan" name="" value="Batalkan">
		</div>
	</div>
		
</form>


<script type="text/javascript">
	$(document).ready(function(){
		var max_char = 0;
		$('#nkonten').html(max_char);
		$('#konten').keyup(function(){
			var textlength = $('#konten').val().length;
			var textR = max_char + textlength;
			$('#nkonten').html(textR);
		})
		$('.batalkan').on('click', function(){
		    if(confirm("Data ini akan dihapus?")){
		        var hari = $('#hari:checked').val();
    		    var jam = $('#jam').val();
    		    $.ajax({
    		        url     : 'act/batalkan_sms_promo.php',
    		        data    : 'hari='+hari+'&jam='+jam,
    		        success : function(data){
    		            window.location = "";
    		        },
    		    })
		    }
    		    
		})
	})
</script>