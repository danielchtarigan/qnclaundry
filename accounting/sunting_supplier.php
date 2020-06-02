

<?php 
include 'config.php';
$id = $_POST['id'];


$query = mysqli_query($con, "SELECT * FROM supplier WHERE id='$id'");
$row = mysqli_fetch_array($query);
	$date = date('Y-m-d');
	$th = substr(date('Y'), 2) ;
	$bl = date('m');
	$no = 'SP'.$th.$bl.'-'.sprintf('%03s', $row['id']);
	?>
	
	<tr>
		<td align="left"><?php echo $no ?></td>
		<td contenteditable="true" data-id="<?= $id ?>" class="nama_supplier"><?php echo ucwords($row['nama_supplier']) ?></td>
		<td contenteditable="true" data-id2="<?= $id ?>" class="alamat"><?php echo $row['alamat'] ?></td>
		<td contenteditable="true" data-id3="<?= $id ?>" class="phone"><?php echo $row['phone'] ?></td>
		<td contenteditable="true" data-id4="<?= $id ?>" class="contact"><?php echo $row['contact'] ?></td>
		<td contenteditable="true" data-id5="<?= $id ?>" class="ppn" value="<?= $row['ppn']; ?>"><?php echo $row['ppn']; ?></td>
		<td align="center">
			<button class="btn btn-xs btn-success selesai-data" id="<?php echo $row['id'] ?>">Selesai</button>
		</td>
	</tr>



	<script type="text/javascript">
		$(document).ready(function(){

			function sunting_data(id,text,nama_colom)
			{
				$.ajax({
					url 	: 'action/tambah_supplier.php',
					method	: 'POST',
					data 	: {id:id, text:text, nama_colom:nama_colom},
					success : function(data){
						$('.pesan-data').html(data).css({"background-color": "#b5f694", "text-align": "center"});
					}
				})
			}

			$(document).on('blur', '.nama_supplier', function(){
				var id = $(this).data('id');
				var supplier = $(this).text();
				sunting_data(id,supplier,"nama_supplier");
			});

			$(document).on('blur', '.alamat', function(){
				var id = $(this).data('id2');
				var alamat = $(this).text();
				sunting_data(id,alamat,"alamat");
			});

			$(document).on('blur', '.phone', function(){
				var id = $(this).data('id3');
				var phone = $(this).text();
				sunting_data(id,phone,"phone");
			});

			$(document).on('blur', '.contact', function(){
				var id = $(this).data('id4');
				var contact = $(this).text();
				sunting_data(id,contact,"contact");
			});

			$(document).on('blur', '.ppn', function(){
				var id = $(this).data('id5');
				var ppn = $(this).text();
				sunting_data(id,ppn,"ppn");
			});

			$('.selesai-data').on('click', function(e){
				window.location ="";
			});			
		
		});
	</script>