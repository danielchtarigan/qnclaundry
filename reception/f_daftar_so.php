<html>
<head>
<?php 
require "header.php";
include "../config.php"; 
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

?>
</head>
<body>
<div  class="container-fluid" style="width:500px;
   margin:0 auto; 
   position:relative; 
   border:3px solid rgba(0,0,0,0); 
   -webkit-border-radius:5px; 
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
<fieldset>
<legend align="center"><strong>DAFTAR BELUM SO (STOK OPNAME)</strong></legend> 
	<table id="belumkembali" class="display" >
		<thead>
		<tr>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
		</tr>
		</thead>
		<tbody>
			<?php
  			$q2=mysqli_query($con,"select * from reception where rcp_so='' and ambil = false and kembali='1' and nama_outlet='$us'");
				while($data = mysqli_fetch_array($q2)){
					?>
				<tr id="<?php echo $data['id']; ?>">
				<td>
				<?php echo $data['tgl_input']; ?></td>
				<td><?php echo $data['no_nota']; ?></td>
				<td><?php echo $data['nama_customer']; ?></td>
				</tr>
				<?php } 
				?>
		</tbody>
	</table>
</fieldset>
</div>

</body>

	<script type="text/javascript">
        $(function() {
            $("#no_nota").focus();
        });
    </script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#belumkembali').dataTable();
			$('#belumspk').dataTable();
$('#subagen').dataTable();

		});
		</script>
		

</html>