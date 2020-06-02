<?php 
include '../../config.php';

$sql = mysqli_query($con, "SELECT * FROM reception a, customer b WHERE a.id_customer=b.id AND a.no_nota='$_GET[nota]'");
$result = mysqli_fetch_assoc($sql);

$jenis = $result['jenis'];

if($jenis=="k") {
	$ritems = mysqli_query($con, "SELECT * FROM order_tmp WHERE no_nota='$_GET[nota]'");
} else if($jenis=="p") {
	$ritems = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE no_nota='$_GET[nota]'");
}

?>



<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Form SPK</h4>		
	</div>
	<div class="panel-body">
		<span class="pull-right" style="font: 14px tahoma; font-weight: bold"><?php echo $result['nama_customer'].' | '.$result['no_nota'] ?></span><br>
		<?php 
			while($re = mysqli_fetch_assoc($ritems)){
			?>
			<span class="pull-right" style="font: 14px tahoma"><?php echo $re['item'] ?></span><br>
			<?php
		}
		?>
			

		<hr>

		<table align="center">
			<tr>
				<td colspan="2">
					<select class="chosen-select form-control" id="item_spk" data-placeholder="Pilih Item SPK">
						<option value="">  </option>
						<?php 
						$query = mysqli_query($con, "SELECT * FROM spk_item");
						while($row = mysqli_fetch_assoc($query)){
							?>
							<option><?= $row['nama_item'] ?></option>
							<?php
						}

						?>
					</select>
				</td>
			</tr>
			<tr class="hide">
				<td></td>
				<td align="center">
					<input class="form-control spinner1" type="text" name="" id="jumlah" placeholder="jumlah">
				</td>
			</tr>
			<tr class="hide">
				<td colspan="2"><input class="form-control" placeholder="Keterangan Item" id="ket"></td>
			</tr>
			<tr class="hide">
				<td colspan="2" align="center"><button class="btn btn-minier btn-primary btn-tambah" disabled="">Tambah</button></td>
			</tr>
		</table>

		<table class="table table-condensed table-tambah" style="margin-top: 15px">
			<thead>
				<tr>
					<th></th>
					<th>Jenis Item</th>
					<th width="2%">Jumlah</th>					
				</tr>
			</thead>
			<tbody>
				<?php 
				$query = mysqli_query($con, "SELECT * FROM detail_spk WHERE no_nota='$_GET[nota]' ORDER BY id DESC");
				while($data = mysqli_fetch_array($query)) {
					?>
					<tr id="d">
						<td style="text-align: center; width: 2%"><button class="btn btn-white btn-minier btn-danger no-border btn-hapus" href="#" title="Hapus" id="<?= $data['id'] ?>"><i class="ace-icon glyphicon glyphicon-trash"></i></button></td>
						<td><?php echo $data['jenis_item'] ?></td>
						<td style="text-align: center"><?php echo $data['jumlah'] ?></td>
						
					</tr>

					<?php
				} 
				
				?>
				<!-- <tr>
					<td align="center" colspan="3">-- 0 --</td>
				</tr> -->

			</tbody>
		</table>
		<!-- <table id="smn">
			<?php 
			if(mysqli_num_rows($query)>0) {
				?>
				<tr>
					<td><button class="btn btn-sm btn-success btn-selesai"> Selesai</button></td>
				</tr>

				<?php
			}

			?>
		</table> -->
	</div>
</div>

<script type="text/javascript">
	jQuery(function($) {
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true});
		}	

		$('.spinner1').ace_spinner({value:1,min:0,max:200,step:1, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
			.closest('.ace-spinner')
			.on('changed.fu.spinbox', function(){
			//console.log($('#spinner1').val())
		});

		
		$("#item_spk").change(function(){
			var item = $("#item_spk").val();
			if(item=='') {
				$("#jumlah").val(0);
				$(".btn-tambah").prop('disabled', true);
			} else {
				$(".hide").removeClass('hide');
				$("#jumlah").val(1);
				$(".btn-tambah").prop('disabled', false);
			}
		})

		$(".btn-tambah").on('click', function(){
			var nota = "<?php echo $_GET['nota'] ?>";
			var item = $("#item_spk").val();
			var jum = $("#jumlah").val();
			var ket = $("#ket").val();
			$.ajax({
				url 	: 'include/tabel_spk.php',
				data 	: 'nota='+nota+'&item='+item+'&jum='+jum+'&ket='+ket,
				beforeSend : function(){
					$("#d").html("<td colspan='3' style='text-align: center'>sedang menyimpan...</td>");
				},
				success : function(data){
					$(".table-tambah").html(data);
				}
			})
		});


		$(".btn-hapus").click(function(){
			var id = $(this).attr('id');
			var nota = '<?php echo $_GET['nota'] ?>';
			$.ajax({
				url 	: 'include/tabel_spk.php',
				data 	: 'hapus=hapus&id='+id+'&nota='+nota,
				beforeSend : function(){
					$("#d").html("<td colspan='3' style='text-align: center'>sedang menghapus...</td>");
				},
				success : function(data){
					$(".table-tambah").html(data);
				}
			})
		});

		$(".btn-selesai").click(function(){
			var nota = '<?php echo $_GET['nota'] ?>';
			$.ajax({
				url 	: 'action/simpan_spk.php',
				data 	: 'nota='+nota,				
				success : function(data){
					window.location="";
				}
			})
		})

		// $( "#show-option" ).tooltip({
		// 	show: {
		// 		effect: "slideDown",
		// 		delay: 250
		// 	}
		// });
	
		// $( "#hide-option" ).tooltip({
		// 	hide: {
		// 		effect: "explode",
		// 		delay: 250
		// 	}
		// });

		// $( ".btn-hapus" ).tooltip({
		// 	show: null,
		// 	position: {
		// 		my: "left top",
		// 		at: "left bottom"
		// 	},
		// 	open: function( event, ui ) {
		// 		ui.tooltip.animate({ top: ui.tooltip.position().top + 3 }, "fast" );
		// 	}
		// });
	})
</script>


