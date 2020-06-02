<?php 
include 'config.php';

if(isset($_POST['kode'])){ ?>
	<div class=" panel panel-success">
		<div class="pesan"></div>
			<div>		
				<table class="table">
				   	<tr>
				     	<td>
					      	<?php 
					      	$query = mysqli_query($con, "SELECT * FROM nama_item WHERE kode_item='$_POST[kode]'");
					      	$row = mysqli_fetch_assoc($query);
					      	$kode_item = $row['kode_item'];
					      	$item = $row['nama_item'];
					      	?>
					      	<input class="hidden" type="text" name="kode_item" id="kode_item" value="<?php echo $kode_item ?>">
					      	<input class="form-control" type="text" name="item_baru" id="item_edit" value="<?php echo $item ?>">
					    </td>
				    </tr>
					<tr>
					 	<td align="center"><input class="btn btn-md btn-success" type="submit" name="submit" id="sb" value="Simpan"	>
					</tr>	      				
				</table>
			</div>   
	</div> 
<?php
} else if(isset($_POST['kodex'])){ ?>
		<div class="pesanx" align="center"></div>
		<div>			
			<p align="center">Hapus?</p>
			<input class="hidden" type="text" name="kodex" id="kodex" value="<?php echo $_POST['kodex'] ?>">
			<div align="center">				
				<button class="btn btn-default btn-xs hapus">Ya</button>	
			</div>
				

		</div>
	
<?php
}
?>


		   

		<script type="text/javascript">
			$(document).ready(function(){
				$("#sb").click(function(){			
					var kode = $("#kode_item").val();
					var item_baru = $("#item_edit").val();
					$.ajax({
						type : 'post',
			            url : 'action/edit_item.php',
			            data :  'kode='+ kode +'&item_baru=' + item_baru,
			            success : function(data){
			            $('.pesan').html(data);//menampilkan data ke dalam modal
			            }
					})
				});

				$(".hapus").click(function(){			
					var kode = $("#kodex").val();
					$.ajax({
						type : 'post',
			            url : 'action/edit_item.php',
			            data :  'kodex='+ kode,
			            success : function(data){
			            $('.pesanx').html(data);//menampilkan data ke dalam modal
			            }
					})
				})
			})
		</script>