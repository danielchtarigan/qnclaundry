<?php 
include '../config.php'; 
require "header.php";
$no_nota=$_GET['no_nota'];
?>
<table id="semua" class="display" border="1">
<?php 


$query = "SELECT nama_customer,no_nota FROM reception WHERE no_nota='$no_nota'" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){?>
			
			Nama : <?php echo $data['nama_customer'];?> ||
			No nota : <?php echo $data['no_nota'];
			?>
			
			<?php	
				
			}
                       
?>
		<thead>
		<tr>
			<th>Item</th>
			<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM detail_spk WHERE no_nota='$no_nota'" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){
                        ?>
				<tr>
						
						<td><?php echo $data['jenis_item'] ; ?></td>
						<td><?php echo $data['jumlah'] ; ?></td>
						
				 </tr>
				  <?php } 
 ?>   
		</tbody>
		<tfoot>
		<input type="hidden" class="form-control" id="no_nota" name="no_nota" value="<?php echo $no_nota ?>" />
			<tr>
          <td colspan="1"><div align="right">Total: </div></td>
          <td colspan="2"><div align="left">
		  <?php
		 
		  $query =mysqli_query($con, "SELECT sum(jumlah) as jumlah FROM detail_spk WHERE no_nota='$no_nota'");

			while($rows = mysqli_fetch_array($query))
			{
			echo $rows['jumlah']; 
		  }
		  ?>
		  
		  
		  </div></td>
        </tr>
		</tfoot>
	</table>
	<script> $(document).ready(function() { 
$('#semua').dataTable();

} );
	</script>