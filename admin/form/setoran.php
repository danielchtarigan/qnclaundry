<?php 
function number($angka){
	$number = number_format($angka,0,',','.');
	return $number;
}
?>

<legend>Setoran Bank By Accounting</legend>

<div class="modal fade f-setoran" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-xs" role="document">
    	<div class="modal-content">    	
        	<div class=" panel panel-success">
				<div class="panel-heading">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="panel-title">Form Setoran</h3>
				</div>
				<div class="panel-body">
					<div id="hasil"></div>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-4">Tanggal Setoran</label>
							<div class="col-md-6">
								<input class="form-control" type="text" name="tanggal" id="tanggal" placeholder="Tanggal Menyetor">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">Nama Penyetor</label>
							<div class="col-md-6">
								<select class="form-control" id="penyetor" name="penyetor">
									<option value="--Pilih Nama Resepsionis--">--Pilih Nama Resepsionis--</option>
									<?php 
									$query = mysqli_query($con, "SELECT name,cabang FROM user WHERE level='reception' AND aktif='Ya' AND cabang<>'' GROUP BY cabang,name ORDER BY cabang,name ASC");
									while($uname = mysqli_fetch_row($query)){
										if($uname[1]=="makassar") {
											echo '<option value="'.$uname[0].'">'.ucwords($uname[0]).' | '.strtoupper($uname[1]).'</option>';
										} else {
											echo '<option value="'.$uname[0].'" style="color: #0459ed">'.ucwords($uname[0]).' | '.strtoupper($uname[1]).'</option>';
										}

										
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">Jumlah Setoran</label>							
							<div class="col-md-6">
								<div class="input-group">
									<div class="input-group-addon">Rp</div>
									<input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="">
								</div>									
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">Bank/Apotik</label>
							<div class="col-md-6">
								<select class="form-control" id="bank" name="bank">
									<option>--Pilih Bank/Apotik--</option>
									<option>Apotik</option>
									<option>BRI</option>
									<option>BCA</option>
									<option>BNI</option>
									<option>Permata</option>
									<option>Mandiri Mjk</option>
									<option>Lain-Lain</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-10">
								<textarea class="form-control" id="ket" placeholder="ket (Optional)"></textarea>
							</div>
						</div>
						<button class="btn btn-md btn-success" id="submit" name="submit">Submit</button>
					</div>							
				</div>
			</div>
    	</div>
  	</div>
</div>	

<div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">    	
			<div class="panel-body">
				<div class="m-edit" align="center"></div>				
			</div>
		</div>
	</div>
</div>	

<div class="row">
	<div class="col-md-6 col-xs-6 col-sm-6">
		<button class="btn btn-md btn-success" data-toggle="modal" data-target=".f-setoran">Form Setoran</button>
	</div>
		
	<div class="col-md-6 col-xs-6 col-sm-6" align="right">
		<form class="form-inline">
			<input class="hidden" type="text" name="form" value="Setoran">
			<div class="input-group">
				<input class="form-control" type="text" name="nama" value="" placeholder="name rcp or bank">	
				<div class="input-group-btn"><button class="btn btn-md btn-default" type="submit" name="cari" value="Setoran"><i class="fa fa-search" aria-hidden="true"></i></button></div>							
			</div>
				
		</form>
	</div>
</div><br>
<div id="pesan"></div>
<div class="rincian">
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Setor</th>
				<th>Nama Resepsionis</th>
				<th>Jumlah Setoran</th>
				<th>Nama Bank</th>
				<th>Deskripsi</th>
				<?php 
				if($_SESSION['user_id']=='jonathan' || $_SESSION['user_id']=='Laura') 
					echo '<th>Action</th>';
				?>
			</tr>
		</thead>
		<tbody>
			<?php 
			$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10;
			$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
			$rowpage = ($page*$limit)-$limit;
			$links = 2;
			$no = ($page*$limit)-$limit+1 ;

			$sresp = (isset($_GET['cari'])) ? $_GET['nama'] : "";
			$cari = (isset($_GET['cari'])) ? $_GET['cari'] : "";
				
			$query = mysqli_query($con, "SELECT *FROM setoran_bank_sebenarnya WHERE nama LIKE '%$sresp%' OR nama_bank LIKE '%$sresp%' ORDER BY id DESC LIMIT $rowpage,$limit");
			while($data = mysqli_fetch_assoc($query)){ ?>
			<tr>
				<td align="center"><?php echo $no++; ?></td>
				<td><?php echo date('d/m/Y', strtotime($data['tanggal'])) ?></td>
				<td><?php echo ucwords($data['nama']) ?></td>
				<td style="text-align: right"><?php echo number($data['jumlah']) ?></td>
				<td><?php echo $data['nama_bank'] ?></td>
				<td><?php echo $data['ket'] ?></td>
				<?php 
				if($_SESSION['user_id']=='jonathan' || $_SESSION['user_id']=='Laura') echo '<td class="xlong"><button class="btn btn-xs btn-warning tooltips f-edit" data-toggle="modal" data-target=".edit" id="'.$data['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span class="tooltiptext">Edit</span></button> | <button class="btn btn-xs btn-danger tooltips f-remove" id="'.$data['id'].'">X<span class="tooltiptext">Remove</span></button></td>';
				?>			
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>

	<?php 
	$query = mysqli_query($con, "SELECT * FROM setoran_bank_sebenarnya");
	$count = mysqli_num_rows($query);
	$last = ceil($count/$limit);
	$start = (($page - $links)>0) ? $page - $links : 1;
	$end = (($page + $links) < $last) ? $page + $links : $last;
		
	?>	
	<nav aria-label="..." align="left">
	  <ul class="pagination">	  	
	  	<?php 
	  	if(isset($_GET['cari'])){
	  		$class = ($page==1) ? "disabled" : "";
			$prev = ($page==1) ? '<li class="'.$class.'"><a href="" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>' : '<li class="'.$class.'"><a href="laporan.php?form=Setoran&nama='.$sresp.'&cari='.$cari.'&limit='.$limit.'&page='.($page-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		  	echo $prev;

		  	if($start>1){
		  		echo '<li class=""><a href="laporan.php?form=Setoran&nama='.$sresp.'&cari='.$cari.'&limit='.$limit.'&page=1"><span class="">First</span></a></li>';
		  		echo '<li class="disabled"><a href=""><span class="">...</span></a></li>';
		  	}

		  	for ($i=$start; $i<=$end ; $i++) { 
		  		$class = ($page==$i) ? "active" : "";
		  		echo '<li class="'.$class.'"><a href="laporan.php?form=Setoran&nama='.$sresp.'&cari='.$cari.'&limit='.$limit.'&page='.$i.'"><span class="">'.$i.'</span></a></li>';
		  	}
		  	if($end < $last){
		  		echo '<li class="disabled"><a href=""><span class="">...</span></a></li>';
		  		echo '<li class=""><a href="laporan.php?form=Setoran&nama='.$sresp.'&cari='.$cari.'&limit='.$limit.'&page='.$last.'"><span class="">Last</span></a></li>';
		  	}

		  	$class = ($page==$last) ? "disabled" : "";
		  	$next = ($page==$last) ? '<li class="'.$class.'"><a href="" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>' : '<li class="'.$class.'"><a href="laporan.php?form=Setoran&nama='.$sresp.'&cari='.$cari.'&limit='.$limit.'&page='.($page+1).'" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>';
		  	echo $next;
		  	
	  	} else{
	  		$class = ($page==1) ? "disabled" : "";
			$prev = ($page==1) ? '<li class="'.$class.'"><a href="" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>' : '<li class="'.$class.'"><a href="laporan.php?form=Setoran&limit='.$limit.'&page='.($page-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		  	echo $prev;

		  	if($start>1){
		  		echo '<li class=""><a href="laporan.php?form=Setoran&limit='.$limit.'&page=1"><span class="">First</span></a></li>';
		  		echo '<li class="disabled"><a href=""><span class="">...</span></a></li>';
		  	}

		  	for ($i=$start; $i<=$end ; $i++) { 
		  		$class = ($page==$i) ? "active" : "";
		  		echo '<li class="'.$class.'"><a href="laporan.php?form=Setoran&limit='.$limit.'&page='.$i.'"><span class="">'.$i.'</span></a></li>';
		  	}
		  	if($end < $last){
		  		echo '<li class="disabled"><a href=""><span class="">...</span></a></li>';
		  		echo '<li class=""><a href="laporan.php?form=Setoran&limit='.$limit.'&page='.$last.'"><span class="">Last</span></a></li>';
		  	}

		  	$class = ($page==$last) ? "disabled" : "";
		  	$next = ($page==$last) ? '<li class="'.$class.'"><a href="" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>' : '<li class="'.$class.'"><a href="laporan.php?form=Setoran&limit='.$limit.'&page='.($page+1).'" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>';
		  	echo $next;
	  	}
		?>	

	  </ul>
	</nav>
</div>

<?php 

?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#submit").click(function(){
			var simpan = "simpan";
			var tgl = $("#tanggal").val();
			var nama = $("#penyetor").val();
			var jumlah = $("#jumlah").val();
			var bank = $("#bank").val();
			var ket = $("#ket").val();
			$.ajax({
				url : "act/setoran_mut.php",
				type : "GET",
				data : {simpan : simpan, tgl : tgl, nama : nama, jumlah : jumlah, bank : bank, ket : ket},
				dataType : "html",
				success : function(data){
					$("#hasil").html(data);	
				}
			})
		});

		$(".f-edit").click(function(){
			var edit = "edit";
			var id = $(this).attr('id');
			$.ajax({
				url		: "form/edit_setoran.php",
				data 	: "edit="+ edit +"&id="+ id,
				success : function(data){
					$(".m-edit").html(data);
				}
			})
		})

		$(".f-remove").click(function(){
			if(confirm("Yakin setoran ini dihapus?"))
			{
				var hapus = "hapus";
				var id = $(this).attr('id');
				$.ajax({
					url		: "form/edit_setoran.php",
					data 	: "hapus="+ hapus +"&id="+ id,
					success : function(data){
						$("#pesan").html(data);
					}
				})
			}				
		})
	})
</script>

