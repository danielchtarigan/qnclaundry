<?php
include 'header.php';

date_default_timezone_set('Asia/Makassar');
$jam = date('Y-m-d H:i:d');

?>

<style>
.tooltips .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
}


.tooltips:hover .tooltiptext {
  visibility: visible;
}
</style>

<script type="text/javascript">
	$(document).ready(function(){		

		$('#dataall, #dataallpotongan').dataTable({
    		"order": [[ 0,"asc" ]],
    		"iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            "bJQueryUI" : true,
			"sPaginationType" : "full_numbers",
    		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
    			if (aData[2] == "0" && aData[10] >= 5)
                {
                    $('td', nRow).css('background-color', '#beaed2').css('color', 'black').css('font-weight', 'bold');
    
                }
                else if(aData[2] == "1" && aData[10] >= 24 && aData[10] < 48)
                {
                	$('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
                }
                else if(aData[2] == "1" && aData[10] >= 48)
                {
                	$('td', nRow).css('background-color', 'red').css('color', 'black').css('font-weight', 'bold');
                }
            }
    	});
    	
    	$('.data-order').click(function(){
    		var order = $(this).attr('id');
    		$.ajax({
    			url 	: '../admin/rincian_order.php',
    			data 	: 'order='+order,
    			beforeSend : function(){
    				$('.rincian').html('<div align="center">sedang mencari...</div>');
    			},
    			success : function(data){
    				$('.rincian').html(data);
    			}
    		});
    	});
		    
	
	})
</script>

	
    <div class="modal fade" id="rincian_order" tabindex="-1" role="dialog">
    	<div class="modal-dialog modal-sm" role="document">
    		<div class="modal-content">
    			<div class="rincian">
    				
    			</div>
    		</div>
    	</div>
    </div>
    <div class="container-fluid" style="width:950px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:70px; color:#000000;">
	<div class="table-responsive" style="margin-top: 25px">
		<legend align="center" ><marquee behavior=alternate  width="800">Kiloan Belum Kembali</marquee></legend>

		<div style="margin-bottom: 20px">
			<button id="cek" type="button" class="btn btn-white btn-xs hide" style="background-color: white" title="Trash">
				<i class="fa fa-trash-o fa-2x" aria-hidden="true" style="color: red"></i>
			</button>
		</div>

		<table class="table table-striped" style="font-size: 11px" id="dataall">
			<thead>
				<tr>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>Checkin</th>
					<th>Cuci</th>
					<th>Setrika</th>
					<th>Packing</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 

				$sql = $con-> query("SELECT a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu,a.tgl_workshop,a.op_workshop, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, rcp_spk FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.nama_outlet='$ot' AND a.jenis='k' AND a.kembali=false AND a.tgl_so='0000-00-00 00:00:00' AND ambil=false AND a.rijeck=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND b.Kota='Makassar' AND status_order='' ORDER by a.tgl_input DESC");
				while($data = $sql-> fetch_array()){
					$waktus = explode(":",$data['waktu']); 

					?>
					<tr>
						<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
						<td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
						<td class="hide"><?= $data['spk'] ?></td>
						<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
						<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_workshop']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">OP : '.$data['op_workshop'].'<br>'.$data['tgl_workshop'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Cuci : '.$data['op_cuci'].'<br>'.$data['tgl_cuci'].'</span>' : 'Belum';
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Setrika : '.$data['user_setrika'].'<br>'.$data['tgl_setrika'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_packing']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Packer : '.$data['user_packing'].'<br>'.$data['tgl_packing'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 							
							echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
							?>
						</td>
						<td class="hide"><?= $waktus[0]; ?></td>
					</tr>

					<?php
				}


				?>
			</tbody>
		</table>
	</div>
	</div>
	
	<div class="container-fluid" style="width:950px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:70px; color:#000000;">

	<div class="table-responsive">
		<legend align="center" style="margin-top: 25px"><marquee behavior=alternate  width="800">Potongan Belum Kembali</marquee></legend>

		<div style="margin-bottom: 20px">
			<button id="cek2" type="button" class="btn btn-white btn-xs hide" style="background-color: white" title="Trash">
				<i class="fa fa-trash-o fa-2x" aria-hidden="true" style="color: red"></i>
			</button>
		</div>

		<table class="table table-striped" style="font-size: 11px" id="dataallpotongan">
			<thead>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>Checkin</th>
					<th>Cuci</th>
					<th>Setrika</th>
					<th>Packing</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 

				$sql = $con-> query("SELECT a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu,a.tgl_workshop,a.op_workshop, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, rcp_spk FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.nama_outlet='$ot' AND a.jenis='p' AND a.kembali=false AND a.tgl_so='0000-00-00 00:00:00' AND ambil=false AND a.rijeck=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND b.Kota='Makassar' AND status_order='' ORDER by a.tgl_input DESC");
				while($data = $sql-> fetch_array()){
					$waktus = explode(":",$data['waktu']); 

					?>
					<tr>
						<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
						<td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
						<td class="hide"><?= $data['spk'] ?></td>
						<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
						<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_workshop']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">OP : '.$data['op_workshop'].'<br>'.$data['tgl_workshop'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Cuci : '.$data['op_cuci'].'<br>'.$data['tgl_cuci'].'</span>' : 'Belum';
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Setrika : '.$data['user_setrika'].'<br>'.$data['tgl_setrika'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_packing']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Packer : '.$data['user_packing'].'<br>'.$data['tgl_packing'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 							
							echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
							?>
						</td>
						<td class="hide"><?= $waktus[0]; ?></td>
					</tr>

					<?php
				}


				?>
			</tbody>
		</table>
	</div>
	</div>
	



