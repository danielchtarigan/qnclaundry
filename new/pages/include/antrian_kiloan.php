<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Cuci Pengering</h4>
		<div class="widget-toolbar">
			<a href="#" data-action="collapse">
				<i class="ace-icon fa fa-chevron-up"></i>
			</a>
		</div>
	</div>

	<div class="widget-body">
		<div class="widget-main table-responsive">
			<table class="table table-bordered table-condensed" id="antrian">
				<thead>
					<tr>
						<th width="8%">No Order</th>
						<th>Cuci</th>
						<th>Kering</th>
						<th width="2%">Hari</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					$outlet = $_SESSION['outlet'];
					
					if($_SESSION['level']=="mitra")
					{
					    $query = mysqli_query($con, "SELECT * FROM reception WHERE  workshop='$outlet' AND jenis='k' AND spk=true AND packing=false AND kembali=false AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND (cuci=false OR pengering=false) AND rijeck=false ORDER BY tgl_input ASC");
					}
					else 
					{
					    $query = mysqli_query($con, "SELECT * FROM reception WHERE (nama_outlet='$outlet' OR workshop='$outlet') AND jenis='k' AND spk=true AND packing=false AND kembali=false AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND (cuci=false OR pengering=false) AND rijeck=false ORDER BY tgl_input ASC");
					}
					
					
					while($data = mysqli_fetch_array($query)){ 
						$nota = $data['no_nota']; ?>
						<tr>
							<td><a href=# class="data-order" data-toggle="modal" data-target="#rinc_order" id="<?php echo $nota ?>"><?php echo $nota ?></a></td>
							<td>
								<?php 
								if($data['cuci']=='0'){
									echo '<button data-toggle="modal" data-target="#fform" class="btn btn-xs btn-success cuci" id="'.$nota.'">Proses</button>';
								} else{
									echo date('d/m/Y H:i', strtotime($data['tgl_cuci']));
								}
								?>						
							</td>
							<td>
								<?php 
								if($data['cuci']=='1' AND $data['pengering']=='0'){
									echo '<button data-toggle="modal" data-target="#fform" class="btn btn-xs btn-success kering" id="'.$nota.'">Proses</button>';
								} else if($data['cuci']=='1' AND $data['pengering']=='1'){
									echo date('d/m/Y H:i', strtotime($data['tgl_pengering']));
								} else if($data['cuci']=='0'){
									echo "Menunggu";
								}
								?>						
							</td>
							<td>
								<?php 
								$haries = mysqli_query($con, "SELECT DATEDIFF('$nowDate', tgl_input) FROM reception WHERE no_nota='$nota'");
								$hari = mysqli_fetch_row($haries)[0];
								echo $hari;
								?>
							</td>
						</tr>
							
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Setrika Packing</h4>
		<div class="widget-toolbar">
			<a href="#" data-action="collapse">
				<i class="ace-icon fa fa-chevron-up"></i>
			</a>
		</div>
	</div>

	<div class="widget-body">
		<div class="widget-main table-responsive">
			<table class="table table-bordered table-condensed" id="antrian2">
				<thead>
					<tr>
						<th width="8%">No Order</th>
						<th>Setrika</th>
						<th>Packing</th>
						<th width="2%">Hari</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					$outlet = $_SESSION['outlet'];
					if($_SESSION['level']=="mitra")
					{
					    $query = mysqli_query($con, "SELECT * FROM reception WHERE workshop='$outlet' AND jenis='k' AND spk=true AND packing=false AND kembali=false AND cuci=true AND pengering=true AND (setrika=false OR packing=false) ORDER BY tgl_input ASC");
					}
					else
					{
					    $query = mysqli_query($con, "SELECT * FROM reception WHERE (nama_outlet='$outlet' OR workshop='$outlet') AND jenis='k' AND spk=true AND packing=false AND kembali=false AND cuci=true AND pengering=true AND (setrika=false OR packing=false) ORDER BY tgl_input ASC");
					}
					
					while($data = mysqli_fetch_array($query)){ 
						$nota = $data['no_nota']; ?>
						<tr>
							<td><a href=# class="data-order" data-toggle="modal" data-target="#rinc_order" id="<?php echo $nota ?>"><?php echo $nota ?></a>
							</td>
							
							<td>
								<?php
								$sementara = mysqli_query($con, "SELECT * FROM setrika_sementara WHERE no_nota='$nota'");
								$ada = mysqli_num_rows($sementara);

								if($data['pengering']=='1' AND $data['setrika']=='0'){
									if($ada>0){
										echo '<button data-toggle="modal" data-target="#rinc_order" class="btn btn-xs btn-warning sementara" id="'.$nota.'">Sementara</button>';
									} else {
										echo '<button data-toggle="modal" data-target="#fform" class="btn btn-xs btn-success setrika" id="'.$nota.'">Proses</button>';
									}
									
								} else if($data['pengering']=='1' AND $data['setrika']=='1'){
									echo date('d/m/Y H:i', strtotime($data['tgl_setrika']));
								} else if($data['pengering']=='0'){
									echo "Menunggu";
								}
								?>						
							</td>
							<td>
								<?php 
								if($data['setrika']=='1' AND $data['packing']=='0'){
									echo '<button data-toggle="modal" data-target="#fform" class="btn btn-xs btn-success packing" id="'.$nota.'">Proses</button>';
								} else if($data['setrika']=='1' AND $data['packing']=='1'){
									echo date('d/m/Y H:i', strtotime($data['tgl_packing']));
								} else if($data['packing']=='0'){
									echo "Menunggu";
								}
								?>						
							</td>
							<td>
								<?php 
								$haries = mysqli_query($con, "SELECT DATEDIFF('$nowDate', tgl_input) FROM reception WHERE no_nota='$nota'");
								$hari = mysqli_fetch_row($haries)[0];
								echo $hari;
								?>
							</td>
						</tr>
							
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

</div>

<div class="modal fade" id="fform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
    		<div class="modal-isi"></div>      		
    	</div>    	
  	</div>
</div>

<div class="modal fade" id="rinc_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content">
    		<div id="data_order"></div>      		
    	</div>    	
  	</div>
</div>

<style type="text/css">
	td,th{
		text-align: center;
	}
	th{
		font-size: 9pt;
	}

	@media screen and (max-width: 900px) {
		td,th {
			font-size: 7px;
		}
	}
</style>




<script type="text/javascript"  charset="utf-8">
	$(document).ready(function(){
        $('#antrian, #antrian2').dataTable({
            lengthMenu: [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
            // dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
		     "oLanguage": {
			      "sLengthMenu": "Tampilkan _MENU_",
			      "sSearch": "Pencarian: ", 
			      "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
			      "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
			      "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
			      "sInfoFiltered": "(di filter dari _MAX_ total data)",
			      "oPaginate": {
			          "sFirst": "<<",
			          "sLast": ">>", 
			          "sPrevious": "<", 
			          "sNext": ">"
		       }
	      },
          "sPaginationType":"full_numbers",
          "bJQueryUI":true,
          "order": [[0, "asc"]]
        });
      })    

	$('.data-order').click(function(){
		var cek_order = "order";
		var nota = $(this).attr('id');
		$.ajax({
			url 	: 'form/form_operasional.php',
			data 	: 'cek_order='+cek_order+'&nota='+nota,
			beforeSend : function(){
				$('#data_order').html("<p align='center'>sedang mencari...</p>");
			},
			success : function(data){
				$('#data_order').html(data);
			}
		})
	})

	$('.cuci').click(function(){
		var cuci = "cuci";
		var nota = $(this).attr('id');
		$.ajax({
			url 	: 'form/form_operasional.php',
			data 	: 'cuci='+cuci+'&nota='+nota,
			success : function(data){
				$('.modal-isi').html(data);
			}
		})
	})

	$('.kering').click(function(){
		var kering = "kering";
		var nota = $(this).attr('id');
		$.ajax({
			url 	: 'form/form_operasional.php',
			data 	: 'kering='+kering+'&nota='+nota,
			success : function(data){
				$('.modal-isi').html(data);
			}
		})
	})

	$('.setrika').click(function(){
		var setrika = "setrika";
		var nota = $(this).attr('id');
		$.ajax({
			url 	: 'form/form_operasional.php',
			data 	: 'setrika='+setrika+'&nota='+nota,
			success : function(data){
				$('.modal-isi').html(data);
			}
		})
	})

	$('.sementara').click(function(){
		var sementara = "sementara";
		var nota = $(this).attr('id');
		$.ajax({
			url 	: 'form/form_operasional.php',
			data 	: 'sementara='+sementara+'&nota='+nota,
			success : function(data){
				$('#data_order').html(data);
			}
		})
	})

	$('.packing').click(function(){
		var packing = "packing";
		var nota = $(this).attr('id');
		$.ajax({
			url 	: 'form/form_operasional.php',
			data 	: 'packing='+packing+'&nota='+nota,
			success : function(data){
				$('.modal-isi').html(data);
			}
		})
	})

</script>

