<?php 
include '../config.php';
session_start();
$ot = $_SESSION['nama_outlet'];
date_default_timezone_SET('Asia/Makassar');
$date = date('Y-m-d');

$sdriver = $con->query("SELECT name,keterangan FROM user_driver WHERE status='1' ORDER BY created_at DESC");
$rdriver = $sdriver->fetch_assoc();

function laundryRules($rule = 1) {
	global $con;
	$rules = $con->query("SELECT status FROM laundry_rule_details WHERE laundry_rule_id = 3 AND rule = $rule");
	$row = $rules->fetch_assoc();
	return $row['status'];
}

$lunas = laundryRules(1);
$spk = laundryRules(2);


?>

<a href="#" class="tombol-close" title="Close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
<h2><?= ($rdriver['keterangan']=="kotor") ? "Penyerahan Cucian Kotor Outlet" : "Penerimaan Cucian Bersih Workshop" ?></h2>
<form class="form-horizontal" id="manifest_driver" action="javascript:">
	<div class="form-group">	
		<input class="form-control" type="text" name="nota" id="nota" placeholder="Scan nomor nota di sini ..!" onkeypress="notaHandle(e)">			
	</div>
	<span id="peringatan"></span>

	<div class="col-md-6 hidden" id="satu">
		<?php 
		$i = 0;
		if($rdriver['keterangan']=="kotor") {
			$sql = $con->query("SELECT b.no_nota FROM manifest a, reception b WHERE a.no_nota=b.no_nota AND a.kd_serah='' AND a.outlet='$ot' AND b.spk='$spk' AND DATE_FORMAT(b.tgl_input, '%Y-%m-%d') >= '2019-03-01' ");
		} 
		else {
			$sql = $con->query("SELECT no_nota FROM manifest a, man_serah b WHERE a.kd_serah3=b.kode_serah AND kd_serah3<>'' AND kd_terima3='' AND outlet='$ot'");
		}
		
		while($cekNota = $sql->fetch_array()){
			$no = $cekNota[0];
			$i++;
			echo '<input type="checkbox" name="'.$no.'" value="'.$no.'" class="cb-element" id="'.$no.'" onchange="add_sub(this);"> '.$no.'<br>';
		}

		?>  		
	</div> 

	<div class="form-group hidden">
		<?php 
		$namdriver = $rdriver['name'];
		echo '<input type="text" name="" id="driver" value="'.$namdriver.'" style="color:green">';
		?>
	</div>
	<div class="form-group" align="left" style="width: 10%">
	    <div class="input-group">
	      <div class="input-group-addon" id="jumlah" style="width: 30px; color: green">0</div>
	      <label class="form-control"> dari </label>
	      <div class="input-group-addon" id="darijumlah" style="width: 50px; color: green"></div>
	    </div> 
	</div>
	
	<div class="form-group">
		<textarea class="form-control" readonly="true" rows="6" id="textarea" onclick="this.focus();this.select();"></textarea>
	</div>
	<div class="form-group">
		<input type="button" name="submit" value="Submit" class="btn btn-primary form-control">
	</div>	
	<div id="p"></div>			
</form>

<script type="text/javascript">
	document.getElementById('darijumlah').innerHTML = document.getElementById('satu').getElementsByTagName('input').length;
	function add_sub(el) {
		var inc = document.getElementById('satu').getElementsByTagName('input');
		var jumlah = '';
		var textareaValue = '';  
		for (var i=0;i<inc.length;i++) {
    		if ( inc[i].type === 'checkbox' && inc[i].checked) {
	          	textareaValue += inc[i].value + ' ';
	          	jumlah++;
	    	}
  		}
  		document.getElementById('jumlah').innerHTML = jumlah;
   		document.getElementById('textarea').value = textareaValue;
	}

	$('#nota').keypress(function(e){
		var inc = document.getElementById('satu').getElementsByTagName('input');
		var nota = document.getElementById('nota').value;
		var cek = 0;
		if(e.which === 13) {
			for (var i=0;i<inc.length;i++) {
				if (inc[i].value == nota) {
			          inc[i].checked=true;
			          add_sub(this);
			          cek=1;   
			    }
			}
			if(cek==0) {
				$('#peringatan').text("Nota ini tidak ditemukan!").css('color', '#ff0031');
			} else {
				$('#peringatan').text("");
			}

			$('#nota').val("");
		}
	})

	$('input[name=submit]').click(function(){
		var nota = $('#textarea').val();
		var driver = $('#driver').val();
		var jumlah = $('#jumlah').html();
		var keterangan = "<?= $rdriver['keterangan'] ?>";
		var ot = "<?= $ot ?>";
		$.ajax({
			url 		: 'driver_simpan_manifest.php',
			data 		: {nota:nota,driver:driver,jumlah:jumlah,keterangan:keterangan},
			method		: 'POST',
			success 	: function(data){
				if(confirm("Penerimaan Nota dengan jumlah "+jumlah)){
					if(jumlah>"0") {
						window.open('driver_cetak.php?driver='+driver+'&outlet='+ot+'','page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes');	
					}						
					window.location = "";
				}
			}
		})
	});
	
	$('.tombol-close').click(function(){
		var driver = $('#driver').val();

		$.ajax({
			url 	: 'driver_batalkan.php',
			data 	: {driver:driver},
			method	: 'POST',
			success : function(data){
				if(data=="1") {				
					window.location ="";
				}
			}

		})
	})

</script>