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
<legend align="center"><strong>Data Barang Reject</strong></legend>
<table id="cuci" class="display">
<thead>
    <tr>
        <th>Tanggal Riject</th>
        <th>Customer</th>
        <th>Outlet</th>
        <th>No Nota</th>
        <th>User Reject</th>
        <th>Keterangan</th>	
        <th>Pilihan</th>			
    </tr>
</thead>

<tbody>
<?php
$query = "SELECT * FROM rijeck WHERE status=false ORDER BY tgl_rijeck DESC ";
$tampil = mysqli_query ($con, $query);
while($data = mysqli_fetch_array($tampil))
{
$sql4=mysqli_query($con,"SELECT nama_outlet,nama_customer,nama_outlet, rijeck FROM reception WHERE no_nota='$data[no_nota]'");
$s2=mysqli_fetch_array($sql4);

?>
   <tr>   
    <td><?php echo $data['tgl_rijeck'];?></td>
    <td><?php echo $data['nama_customer'];?></td>
    <td><?php echo $s2['nama_outlet'];?></td>
    <td><?php echo $data['no_nota'];?></td>
    <td><?php echo $data['user_rijeck'];?></td>
    <td><?php echo $data['alasan'];?></td>
    <td style="text-align:center;width:160px">
    <a  class="btn btn-xs btn-warning" href="edit_spk2.php?id=<?php echo $data['no_nota']; ?>"><i class="fa fa-pencil"></i> Lanjutkan</a>
    
    <a class="btn btn-xs btn-danger" href="upreject.php?id=<?php echo $data['no_nota']; ?>"><i class="fa fa-trash"></i> Reject</a>
    </td>				
   </tr>
            <?php } ?>
</tbody>
</table>
</fieldset>
</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
	$('#cuci').dataTable({
			
	"aaSorting": [[ 0, "desc" ]],
	"bJQueryUI" : true,
	"sPaginationType" : "full_numbers",
	"iDisplayLength": 10,
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{
	    	column_number : 2
	    	
		},{
	    	column_number : 4
	    }
	    ]);
	    });
	</script>
</html>