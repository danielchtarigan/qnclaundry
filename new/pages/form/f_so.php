<?php 
include '../config.php';

$dateYes = date('Y-m-d H:i:s', strtotime('-1 days', strtotime($nowDate)));

?>


<div class="col-md-5 col-xs-12">
	<div class="panel panel-default">		
		<div class="panel-body">
			<h4><i class="ace-icon glyphicon glyphicon-tag"></i> Form Stock Opname</h4>			
			<div class="form-horizontal">
			    <input class="form-control" placeholder="Scan Nomor Nota..." autocomplete="off" id="cari">
			    <br>
			    <div class="row">    	
			    	<div class="col-md-6 hidden" id="satu">
			    		<?php 
			    		$query = mysqli_query($con, "SELECT * FROM reception WHERE tgl_so='0000-00-00 00:00:00' AND rcp_so='' AND spk=true AND lunas=true AND kembali=true AND ambil=false AND nama_outlet='$outlet'");
			    		$ncek = mysqli_num_rows($query);
						while($result = mysqli_fetch_assoc($query)){
							$no = $result['no_nota']; ?>
							 <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>" onchange="add_sub(this);"> <?=$no?><br>
							 <?php
						}

			    		?>  		
			    	</div> 
			    	<div class="col-md-4 col-xs-6">
			    		<input type="text" name="" id="jumlah" class="pull-left" readonly="">	
			    		<input type="submit" class="btn btn-so btn-sm btn-success pull-left" name="" value="Simpan" style="margin-top: 10px">		    		
			    	</div> 
			    	<div class="col-md-6 col-md-offset-2 col-xs-4 col-xs-offset-2">
			    		<button class="btn btn-sm btn-default daftar-so pull-right">Tampilkan</button>	
			    		<button class="btn btn-sm btn-default daftar-so pull-right hidden" id="sembunyikan">Sembunyikan</button>		    		
			    	</div> 
			    	<div class="col-md-12 col-xs-4">
			    		 <textarea class="hidden pull-right" id="textarea" name="type" rows="<?=$ncek?>" style="width=100%;" onclick="this.focus();this.select();" readonly required></textarea>
			    	</div>    	  	
			    </div> 		   
		  	</div>
		</div>
	</div>
</div>
  
		  
<div class="col-md-7 col-xs-12">
	<div class="panel panel-default">		
		<div class="panel-body">
			<h4 class="black"> <i class="ace-icon glyphicon glyphicon-list"></i> Cucian Hilang</h4>
			<div class="table-responsive">
				<table id="dynamic-table" class="table table-bordered table-condensed table-striped table-hover" style="font-size: 9pt">
					<thead>
						<tr>
							<th>Tanggal Masuk</th>
							<th>No Nota</th>
							<th>Nama Customer</th>
							<th>SO Terakhir</th>
							<th>Reception SO</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query = mysqli_query($con, "SELECT * FROM reception WHERE tgl_so<'$dateYes' AND spk=true AND lunas=true AND kembali=true AND nama_outlet='$outlet'");
						while($data = mysqli_fetch_array($query)){
							?>
							<tr>
								<td><?php echo date('d/m/Y H:i', strtotime($data['tgl_input'])) ?></td>
								<td><?php echo $data['no_nota'] ?></td>
								<td>
									<?php 
									$customer = mysqli_fetch_row(mysqli_query($con, "SELECT nama_customer FROM customer WHERE id='$data[id_customer]'"))[0];
									echo $customer;

									?>
									
								</td>
								<td><?php if($data['tgl_so']!='0000-00-00 00:00:00') echo date('d/m/Y H:i', strtotime($data['tgl_so'])); else echo 'Belum diSO'; ?></td>
								<td><?php if($data['rcp_so']!='') echo $data['rcp_so']; else echo '-'; ?></td>
								<td><?php if($data['ambil']=='0') echo "Hilang"; else if($data['ambil']=='1') echo "Ambil"; ?></td>
							</tr>

							<?php

						}

						?>
					</tbody>
				</table>
			</div>
				
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function(e){
		$("#cari").keypress(function(e){
			var nota = $(this).val();
			var cbs = document.getElementById('satu').getElementsByTagName('input');
			var cek = 0; 			
			if(e.which === 13) {
				for(var i = 0; i<cbs.length; i++) {
					if(cbs[i].value == nota) {
						cbs[i].checked=true;
						add_sub(this);	
						cek = 1;						
					}
				}	
				if (cek==0) alert('No nota '+nota+' tidak ditemukan');
				$("#cari").val("");
			}
			
		});

		function add_sub(el){
			var cbs = document.getElementById('satu').getElementsByTagName('input');
			var textareaValue = '';	
			var jumlah = 0;
         	for (var i = 0; i<cbs.length; i++) {
			   if(cbs[i].type === 'checkbox' && cbs[i].checked){
			   	textareaValue += cbs[i].value + ' ';
			   	jumlah++;
			   }
			  $("#textarea").val(textareaValue);
			  $("#jumlah").val(jumlah);
			}
		};

		$(".btn-so").click(function(){
			var nota = $("#textarea").val();
			$.ajax({
				url 	: 'action/simpan_so.php',
				data 	: 'nota='+nota,
				type 	: 'POST',
				success : function(data){
					if(confirm("Cetak Stock Opname Anda hari ini?")){
						window.open('document/cetak_so.php','page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes');
					}
					window.location="";
				}
			})
		});

		 $('#dynamic-table').dataTable({
	      "oLanguage": {
		      "sLengthMenu": "Tampilkan _MENU_",
		      "sSearch": "Pencarian: ",
		      "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
		      "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
		      "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
		      "sInfoFiltered": "(di filter dari _MAX_ total data)",
		      "oPaginate": {
		          "sFirst": "First",
		          "sLast": "Last", 
		          "sPrevious": "<", 
		          "sNext": ">"
	            }
            },
          "sPaginationType":"full_numbers",
          "bJQueryUI":true
        });

		$('.daftar-so').on('click', function(){
			$('.daftar-so').addClass('hidden');
			$('#textarea').removeClass('hidden');
			$('#sembunyikan').removeClass('hidden');

		})

		$('#sembunyikan').on('click', function(){
			$('.daftar-so').removeClass('hidden');
			$('#sembunyikan').addClass('hidden');
			$('#textarea').addClass('hidden');

		})
		
	});
</script>

