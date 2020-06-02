<html>
<head>
	
<?php 

include "../config.php"; 

$tgl     = $_POST['tgl'];
	$date    = new DateTime($tgl);
	$newDate = $date->format('Y-m-d');

	$tgl2    = $_POST['tgl2'];
	$date2   = new DateTime($tgl2);
	$newDate2= $date2->format('Y-m-d');
?>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#semua td a.delete').click(function()
		{
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "POST",
					   url: "del_order_rcp.php",
					   data: data,
					   cache: false,
					
					   success: function()
					   {
							parent.fadeOut('slow', function() {$(this).remove();});
					   }
				 });				
			}
		});
		
		// style the table with alternate colors
		// sets specified color for every odd row
		$('table#semua tr:odd').css('background',' #FFFFFF');
	});
	
</script>

</head>
<body>


	
<div  style="margin-bottom:50px; color:#000000;">
<fieldset>

<legend align="center"><strong>Semua</strong></legend> 
<div id="konfirm-box"> Apakah Anda yakin akan menghapus ini?</div>
<table id="semua" class="display">
		<thead>
		<tr>
			
			<th>Tgl Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
<th>total</th>
<th>RCP</th>
<th>Lunas</th>
<th>No faktur</th>
			<th>Tgl Cuci</th>
			<th>Tgl Setrika</th>
			<th>Tgl Packing</th>
			<th>Tgl Kembali</th>
			<th>Rcp Kembali</th>
			<th>Tgl ambil</th>
			<th>Rcp ambil</th>
			<th>Tgl SO</th>
			<th>Rcp SO</th>
			<th>VOID</th>

		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT total_bayar,nama_reception,lunas,no_faktur,id,tgl_input,no_nota,nama_customer,tgl_cuci,tgl_setrika,tgl_packing,tgl_kembali,reception_kembali,tgl_ambil,reception_ambil,tgl_so,rcp_so FROM reception WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
                     ?>
				<tr id="<?php echo $data['id'] ; ?>">
						<td><?php echo $data['tgl_input'] ; ?></td>
						<td><?php echo $data['no_nota']; ?></td>
						<td><?php echo $data['nama_customer']; ?></td>
<td><?php echo $data['total_bayar']; ?></td>
<td><?php echo $data['nama_reception']; ?></td>
<td><?php echo $data['lunas']; ?></td>
<td><?php echo $data['no_faktur']; ?></td>
						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?>
		       
		      
                                                </td>
						
						<td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_setrika'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?></td>
						
						<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_packing'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?></td>
						
			
			<td><?php		       if($data['tgl_kembali']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_kembali'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?></td>
				<td><?php echo $data['reception_kembali']; ?></td>
			
			
				<td><?php		       if($data['tgl_ambil']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_ambil'].'';
					       }
					       else
						   {
						   echo '-';
					       };
						  ?></td>
				<td><?php echo $data['reception_ambil']; ?></td>
			
				<td><?php		       if($data['tgl_so']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_so'].'';
					       }
					       else
						   {
						   echo '-';
					       };
						  ?></td>
				<td><?php echo $data['rcp_so']; ?></td>
				<td>
				<a href="#" class="delete" style="color:#FF0000;"><img alt="" align="absmiddle" border="0"  />hapus</a>
				</td>
				
						 </tr>
							<?php } 
 ?>   
		</tbody>
	</table>
	    <script>
	 $(function () {
//Box Konfirmasi Hapus
            $('#konfirm-box').dialog({
                modal: true,
                autoOpen: false,
                show: "Bounce",
                hide: "explode",
                title: "Konfirmasi",
                buttons: {
  
                    "Ya": function () {
  jQuery.ajax({
  type: "POST",
  url: "del_order_rcp.php",
  data: 'id=' +id,
  success: function(){
  $('#'+id).animate({ backgroundColor: "#fbc7c7" }, "fast")
  .animate({ opacity: "hide" }, "slow");
  }
  });
                    $(this).dialog("close");
                    },
 
                    "Batal": function () {
  //jika memilih tombol batal
                    $(this).dialog("close");
   
                    }
                }
            });
 
//Tombol hapus diklik
            $('.hapus').click(function () {
                $('#konfirm-box').dialog("open");
 //ambil nomor id
                id = $(this).attr('id');
            });
        });
</script>

	</fieldset>
	
</div>
</body>
<script type="text/javascript">
		$(document).ready(function(){
			oTable = $('#semua').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    }

	    
	    ]);
	    
	    
	    
			
		});
	</script>




	
</html>