<?php 
include '../../config.php';


$outlet = $_SESSION['outlet'];

$date = date('d/m/Y');
$hour = date('H:i:s');



$rj = $con-> query("SELECT * FROM reception WHERE nama_outlet='$outlet' AND rijeck=true");
$data = $rj->fetch_array();
if(mysqli_num_rows($rj)>0){ 
	
	?>

	<style type="text/css">
		#pr {
			visibility: hidden;
			opacity: 0;
			margin-top: -170px;

		}

		#info {
			height:auto;
			width: auto;
			padding: 10px;
			background: #ccddad;
			border:2px solid #fff;
			border-radius:8px;
			font:normal 1em Cambria,Georgia,Serif;
			color:#111;
			-webkit-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
			-moz-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
			box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		}

		

		#pr:target {
			visibility:visible;
			opacity: 1;
			background-color: rgba(255,255,255,0.5);
			position:fixed !important;
			position:absolute;
			top:0px;
			left:0px;
			right:0;
			bottom:0;
			margin:0 ;
			padding-top:150px;
			padding-left:430px;
			padding-right:430px;
			z-index: 99999999999;
			-webkit-transition:all 1s;
			-moz-transition:all 1s;
			transition:all 1s;			
		}


	
	</style>

	
		<div class="">
			<h4>QNCLAUNDRY</h4
			<b><?php echo $date.' | '.$hour ?></b>
		</div>
		<br>
			

		<div class="widget-body">
			<div class="widget-main info-reject">			
					
				<?php 
				$rjs = $con-> query("SELECT * FROM rijeck WHERE no_nota='$data[no_nota]'");
				while($datas = $rjs->fetch_array()){
					echo 'Nomor Nota <b>'.$datas['no_nota'].'</b> Direject Oleh '.$datas['user_rijeck'].' Karena '.$datas['alasan'];
				}
				?>
			</div>
		</div>
		<div class="widget-toolbox padding-8 clearfix btn-reject">
			<button class="btn btn-xs btn-info pull-left proses-reject" id="<?= $data['no_nota'] ?>">
				<span class="bigger-110">Proses</span>
			</button>
			
		</div>

	

	<?php
}
?>


<script type="text/javascript">
	$('.proses-reject').click(function(){
		var nota = $(this).attr('id');
		$.ajax({
			method 	: 'POST',
			url 	: 'action/proses_reject.php',
			data 	: 'nota='+nota+'&proses=1',
			beforeSend : function(){
				$(".info-reject").html("<em>Sedang proses...</em>");
			},
			success : function(){
				location.href="?menu=info-reject";
			}
		})
		
	})
</script>