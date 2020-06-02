<?php 
include '../config.php';
// echo $_GET['vendor'];

if(isset($_GET['vendor'])){ ?>
	<select class="form-control" id="item">
		<option value="">--Choose Item--</option>
		<?php 
		$query = mysqli_query($con, "SELECT item FROM requisition WHERE submit=false AND recomended_vendor LIKE '%$_GET[vendor]%' ");
		while($row = mysqli_fetch_assoc($query)){ 
			echo '<option value="'.$row['item'].'">'.$row['item'].'</option>';
			
		} ?>
	</select>
	
	<?php
		
}


?>