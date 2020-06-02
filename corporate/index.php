<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id']; 
?>
</head>
<body>

<div class="container" style="width:1200px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:20px; color:#000000;">

<fieldset>
<legend align="center"><strong>Data Order Hotel</strong>
</legend><table id="rincianspk" class="display">
<thead>
    <tr>
        <th>Tanggal Input</th>
        <th>Nama Hotel</th>
        <th>No Nota</th>
        <th>Berat</th>
        <th>Jumlah</th>
        <th>Cuci</th>
        <th>Kering</th>	
        <th>Setrika</th>	
        <th>Packer</th>	                
		
    </tr>
</thead>

<tbody>
<?php
//$query1 = "SELECT * FROM detail_hotel WHERE status=false ORDER BY tgl_transaksi DESC ";
//$tampil1 = mysqli_query ($con, $query);
//$data1 = mysqli_fetch_array($tampil);

$query = ("SELECT DATE_FORMAT(detail_hotel.tgl_transaksi, '%Y/%m/%d') as tgl_transaksi,detail_hotel.nama_hotel as nama_hotel ,detail_hotel.berat as berat ,sum(detail_hotel.cuci) as cuci ,sum(detail_hotel.kering) as kering ,sum(detail_hotel.setrika) as setrika , sum(detail_hotel.packer) as packer ,detail_hotel.no_nota as no_nota ,sum(detail_hotel.jumlah) as totjum,count(detail_hotel.jumlah) as jumlah FROM detail_hotel GROUP BY no_nota ORDER BY tgl_transaksi and no_nota DESC" )or die(mysqli_error());
$tampil = mysqli_query ($con, $query);
while($data = mysqli_fetch_array($tampil))

//$query1 = "SELECT * FROM hotel_trans WHERE no_nota='$data[no_nota]' ORDER BY tgl_transaksi DESC ";
//$tampil1 = mysqli_query ($con, $query);
//$s2 = mysqli_fetch_array($tampil1);

{

?>
   <tr>   
    <td><?php echo $data['tgl_transaksi'];?></td>
    <td><?php echo $data['nama_hotel'];?></td>
    <td><?php echo $data['no_nota'];?></td>
    <td><?php echo $data['berat'];?></td>
    <td><?php echo $data['totjum'];?></td>
    <td><?php echo $data['cuci'];?></td>
    <td><?php echo $data['kering'];?></td>
	<td><?php echo $data['setrika'];?></td>
    <td><?php echo $data['packer'];?></td>

   </tr>
            <?php } ?>
</tbody>
</table>
</fieldset>
</div>
</body>
<script type="text/javascript">
$(document).ready(function(){
 $('#rincianspk').dataTable({
	  			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
	  			 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 2}
	    
	    ]);
	    	});
	</script>
</html>