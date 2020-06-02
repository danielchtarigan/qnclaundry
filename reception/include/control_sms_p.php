<style type="text/css">
    .tablex {
        border : 5 px solid;
        border-radius: 10px;
        width : 260px;
        height : 60px;
        padding: 25px;
    }
	.trx {
	  	font: normal 12px Arial, Calibri, sans-serif;
	  	background: #ececec;
	}

	.thx, .tdx{
		padding: 5px 10px;
	  	border: 2px solid #EEF7FB;
	}

	.txr:nth-child(2n+0) {
	  	background: #d8d8d8;
	}
	.tdx:hover, td:nth-child(2n+0):hover {
	  	background: #f3f4f4;
	}
	
</style>


<div class="col-md-12 col-md-offset-0" id="hasil">
	<h4>Syarat Customer</h4>
	<form class="form-horizontal">			
		<div class="form-group">
			<label class="control-label col-md-3"><p class="pull-left">Max Kunjungan</p></label>
			<div class="col-md-4">					
				<input class="form-control" type="text" name="" id="frek" value="3" placeholder="Maksimal berkunjung">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><p class="pull-left">Range Awal</p></label>
			<div class="col-md-4">
				<input class="form-control" type="text" name="" id="start" autocomplete="off" placeholder="Dimulai Dari Tanggal">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><p class="pull-left">Range Akhir</p></label>
			<div class="col-md-4">
				<input class="form-control" type="text" name="" id="end" autocomplete="off" placeholder="Sampai Tanggal">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><p class="pull-left">Min Transaksi</p></label>
			<div class="col-md-4">
				<input class="form-control" type="text" name="" id="min" value="0">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><p class="pull-left">Max Transaksi</p></label>
			<div class="col-md-4">
				<input class="form-control" type="text" name="" id="max" value="0">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><p class="pull-left">Jenis Item</p></label>
			<div class="col-md-4">
				<select class="form-control" id="jenis" placeholder="Jenis Item">
					<option value="A">ALL</option>
					<option value="k">Kiloan</option>
					<option value="p">Potongan</option>
				</select>
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="control-label col-md-4">Nama Item</label>
			<div class="col-md-4">
				<select multiple="" class="select2 form-control" data-placeholder="Klik untuk memilih..">
					<?php 
					$sql = mysqli_query($con, "SELECT nama_item FROM item_spk WHERE jenis_item='p' ORDER BY kategory DESC ");
					while($data = mysqli_fetch_array($sql)){
						echo '<option>'.$data[0].'</option>';
					}

					?>
				</select>
			</div>
		</div> -->
		<div class="form-group">
			<label class="control-label col-md-3"><p class="pull-left">Hari SMS</p></label>
			<div class="col-md-4">
				<select multiple="" class="select2 form-control" data-placeholder="  Klik untuk memilih..." id="hari">
					<option value="Sunday">Minggu</option>
					<option value="Monday">Senin</option>
					<option value="Tuesday">Selasa</option>
					<option value="Wednesday">Rabu</option>
					<option value="Thursday">Kamis</option>
					<option value="Friday">Jumat</option>
					<option value="Saturday">Sabtu</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><p class="pull-left">Jam SMS</p></label>
			<div class="col-md-4">
				<select  class="form-control" id="jam">
					<option value="09:00">09:00</option>
					<option value="11:00">11:00</option>
					<option value="13:00">13:00</option>
					<option value="15:00">15:00</option>
					<option value="17:00">17:00</option>
					<option value="19:00">19:00</option>
					<option value="21:00">21:00</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3"><input class="btn btn-md btn-success" type="submit" name="" value="Cari Data"></div>			
		</div>
			
	</form>
</div>

	




<script type="text/javascript">
	$(document).ready(function(){
		$("#start").datepicker({
            format:'yyyy/mm/dd',
        });
		$('#end').datepicker({
			format : 'yyyy/mm/dd'
		});
		$('.select2').select2({allowClear:true});	

		$('form').submit(function(e){
			e.preventDefault();
			var frek = $('#frek').val();
			var hari = $('#hari').val();
			var min = $('#min').val();
			var max = $('#max').val();
			var start = $('#start').val();
			var end = $('#end').val();
			var jenis = $('#jenis').val();
			var jam = $('#jam').val();
			// alert(frek+' '+hari);
			$.ajax({
				url 	: 'act/p_cari_data_sms.php',
				data 	: {frek:frek, hari:hari, min:min, max:max, start:start, end:end, jenis:jenis, jam:jam},
				beforeSend : function(){
					$('#hasil').html("Menghitung Data...");
				},
				success : function(data){
					$('#hasil').html(data);
				}
			})
		})

	});
</script>

