<h3 style="text-align: center;"><strong>Informasi untuk All Outlet</strong></h3><br>


<?php 
include '../config.php';

$info = mysqli_query($con, "select *from informasi");
while($data = mysqli_fetch_array($info)){
?>

<style type="text/css">
	img{
		
		width : 150px;
		height: 150px;	
		margin: 18px 23px;
		
	}
	.gbr{
		width : 200px;
		height: 200px;		
		border: 3px solid #aea8a8;
		position: relative;	
		float: left;
		margin-left: 38px

	}	
</style>	
		

		<div class="gbr">
			<p style="text-align: center"><?php if($data['tampil']==1) echo "Pertama"; else if($data['tampil']==2) echo "Kedua"; else if($data['tampil']==3) echo "Ketiga"; else if($data['tampil']==4) echo "Keempat"; else if($data['tampil']==5) echo "Kelima";?></p>
			<img class="img-responsive" src="../reception/images/<?php echo $data['info_gambar'] ?>">
		</div>		
		


<?php 

}

?>

