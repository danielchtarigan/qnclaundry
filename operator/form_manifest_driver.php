<?php 
include '../config.php';
session_start();
$workshop = $_SESSION['workshop'];

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');

$sdriver = $con->query("SELECT name,keterangan FROM user_driver WHERE status='1' ORDER BY created_at DESC");
$rdriver = $sdriver->fetch_assoc();



?>

<h2><?= ($rdriver['keterangan']=="kotor") ? "Penerimaan Cucian Kotor Outlet" : "Penyerahan Cucian Bersih Workshop" ?></h2>
<form class="form-horizontal" id="manifest_driver" action="javascript:">
	<div class="form-group">	
		<input class="form-control" style="text-align: center; font-size: 20px" type="text" name="nota" id="nota" autocomplete="off" placeholder="Scan nomor nota di sini ..!" onkeypress="notaHandle(e)">			
	</div>
	<span id="peringatan"></span>

	<div class="col-md-6 hidden" id="satu">
		<?php 
		$i = 0;
		if($rdriver['keterangan']=="kotor") {
			$sql = $con->query("SELECT no_nota FROM manifest a, man_serah b WHERE a.kd_serah=b.kode_serah AND a.kd_serah<>'' AND a.kd_terima='' AND DATE_FORMAT(b.tgl, '%Y-%m-%d') >= '2019-03-01' AND b.driver='$rdriver[name]' ");
		} 
		else {
			$sql = $con->query("SELECT no_nota FROM manifest WHERE kd_serah3=''");
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
	<div class="form-group">
	    <div class="input-group">
	      <div class="input-group-addon" id="jumlah" style="width: 30px; color: green;  font-size: 24px">0</div>
	      <label class="form-control" style="font-size: 20px"> dari </label>
	      <div class="input-group-addon" id="darijumlah" style="width: 50px; color: green;  font-size: 24px"></div>
	    </div>    	  
	</div>
	
	<div class="form-group">
		<textarea class="form-control" readonly="true" style="font-size: 20px" rows="6" id="textarea" onclick="this.focus();this.select();"></textarea>
	</div>
	<div class="form-group">
		<input type="button" name="submit" value="Submit" class="btn btn-primary form-control" style="font-size: 20px">
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
		var dariJumlah = document.getElementById('satu').getElementsByTagName('input').length;
		var ws = "<?= $workshop ?>";
		$.ajax({
			url 		: 'driver_simpan_manifest.php',
			data 		: {nota:nota,driver:driver,jumlah:jumlah,keterangan:keterangan,dariJumlah:dariJumlah},
			method		: 'POST',
			beforeSend  : function(){
			    $('#manifest_driver').html("<em>Memproses data...</em>");
			},
			success 	: function(data){
				$('#manifest_driver').html(data);
				setTimeout(function(){ window.location = "" }, 20000);
				
			}
		})
	});
	
</script>