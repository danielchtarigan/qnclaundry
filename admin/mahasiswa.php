<?php  
include '../config.php';
include 'head.php';
include 'auth.php';

?>

<script type="text/javascript" language="javascript">
	$(document).ready(function() {		
		$("td img").hover(function(e){
			$("#large").css("top",(e.pageY+5)+"px")
							 .css("left",(e.pageX+5)+"px")					
							 .html("<img src="+ $(this).attr("alt") +" alt='Large Image'  width='460px' height='260px' /><br/>"+$(this).attr("rel"))
							 .fadeIn("slow");
		}, function(){
			$("#large").fadeOut("fast");
		});

		// $('#tampil').dataTable({
		// 	"order": [[0,"desc"]],
		// 	"columnDefs": [
  //            	{                 	
  //                	"visible": true,
  //                	"searchable": true,"width":"5%",
  //           	 },  { "width": "12%", "targets": 0 }, 
  //        	],         	
		// })  		
		
	});
</script>

<style type="text/css">


#large {
	display: none;
	position:absolute;	
	background:#eee;
	display:none;
	color:#333;	
	padding: 5px;
}
th {
	font-weight: bold;
	font-size: 14px;
	color: green;	
}
#f {
	font-family: cambria
}
</style>


<div class="container"><h3 style="text-align: center; font-weight: bold">Daftar Registrasi Mahasiswa</h3></div><hr>
<div><button class="btn btn-info" data-toggle="modal" data-target=".setting">Setting</button></div>

<div id="f" class="table-responsive">
	<table id="tampil" class="table table-hover table-striped table-condensed">
		<thead>
			<tr>				
				<th>Kartu Mahasiswa</th>				
				<th>No Reg</th>
				<th>Tanggal Reg</th>
				<th>Nama</th>
				<th>Tanggal Lahir</th>				
				<th>Nomor Kartu</th>				
				<th>Nama Sekolah</th>				
				<th>Status KMB</th>
				<th>Outlet Pilihan</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			<?php 
			$qmhs = mysqli_query($con, "SELECT *FROM member_mahasiswa ORDER BY tgl_reg DESC");
			WHILE($mhs = mysqli_fetch_array($qmhs)){
				$gbr = $mhs['image'];
			?>	
				<td>
					<?php 
						echo '<img src="../mahasiswa/media/image/'.$gbr.'" alt="../mahasiswa/media/image/'.$gbr.'" width="130px" height="80px" rel="'.$mhs['nama'].'">'; 
					?>				
				</td>
				<td>QCMHS<?php echo $mhs['id']; ?></td>
				<td><?php echo $mhs['tgl_reg']; ?></td>
				<td><?php echo $mhs['nama']; ?></td>
				<td><?php echo $mhs['tanggal_lahir'] ?></td>
				<td><?php echo $mhs['stambuk_mahasiswa'] ?></td>
				<td><?php echo $mhs['sekolah'] ?></td>
				<td style="font-size: 16px; font-weight: bold"><a href="act/mahasiswa.php?id=<?php echo $mhs['id']; ?>&status=<?php echo $mhs['status'];?>&cust=<?php echo $mhs['id_customer'];?>&telp=<?php echo $mhs['telp']; ?> " >
					<?php 
					if($mhs['status']=="tidak aktif") echo 'Non Aktif'; 
					else echo 'Aktif';
					?>											
					</a>
				</td>			
				<td><?php echo $mhs['outlet'] ?></td>	
								
			</tr>

			<?php
			}
			?>	
		</tbody>
	</table>	
</div>

<p id="large"></p>	


<div class="modal fade setting" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  	<div class="modal-dialog modal-md" role="document">
    	<div class="modal-content">    		
    		<div class="setting-data"></div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
	$('.btn-info').click(function(){
			$.ajax({
				type : 'post',
	            url : 'kontrol_mahasiswa.php',
	            success : function(data){
	            $('.setting-data').html(data);//menampilkan data ke dalam modal
	            }
			})
	})
</script>