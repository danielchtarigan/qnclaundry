<head>
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
 function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
?>
</head>
<body>

<div class="container-fluid" style="width:1000px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
<fieldset>
<legend align="center"><strong>Rincian Cash</strong></legend> 
	<table id="rinciancash" class="display">
		<thead>
		<tr>
			<th>Tgl</th>
			<th >rcp</th>
			
		</tr>
		</thead>
					
		<tbody>
			<?php
			$sql3=mysqli_query($con,"SELECT id_customer,no_nota FROM reception WHERE id_customer != '0'");


					
			while($data = mysqli_fetch_array($sql3)){
			$hr=$data['id_customer'];
				?>
				
					<tr>
					<td><?php echo $data['id_customer'];?></td>
					<td><?php
					
					$sql4=mysqli_query($con,"SELECT * FROM customer WHERE id='$hr'");
$s2=mysqli_fetch_array($sql4);
$nama=$s2['nama_customer'];
echo $nama ;
					?>	
					</td>
					
				</tr>
			
				<?php } 
 ?>
		</tbody>
		
		
		
		
		
		
		
			
	</table>
	</fieldset>



	</div>
</body>
<script type="text/javascript">
		$(document).ready(function(){
			
	    $('#rinciancash').dataTable(
			
	    );
	    
	    });
	</script>