<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 

?>
</head>
<body>

<?php 
$outlet=$_SESSION['nama_outlet']; ?>
<div class="container" style="width:1200px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:20px; color:#000000;">
	<script type="text/javascript">
		$(document).ready(function(){
			oTable = $('#barhil').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],

                dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        
                        {
                            'sExtends': 'xls',
                            
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                        
                    ]
                },
                
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
		 {column_number : 2},{column_number : 0}, {column_number : 3, text_data_delimiter: ",", filter_type: "auto_complete"}
	    
	    ]);
		});
	</script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
</script>	
<fieldset>
<legend align="center" >
<strong>BARANG HILANG</strong><br>
Di Hitung per Hari ini,jika hari ini belum so maka dianggap barhil. Jika ambil customer tidak di input, dianggap barhil.
</legend> 
<table id="barhil" class="display">
		<thead>
		<tr>
			<th>Outlet</th>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Tgl So</th>
			<th>Rcp SO</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$outlet=$_SESSION['nama_outlet'];
			date_default_timezone_set('Asia/Makassar');
			$jam=date("d-m-Y");
			$query = "SELECT nama_outlet,tgl_input,no_nota,nama_customer,DATE_FORMAT(tgl_so, '%d-%m-%Y') as tgl_so,rcp_so FROM reception WHERE DATE_FORMAT(tgl_so, '%d-%m-%Y') <> '$jam' and kembali=true and ambil=false ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			
			
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						
						<td><?php echo $data['nama_outlet'];?></td>
						<td><?php echo $data['tgl_input'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
						<td><?php		       if($data['tgl_so']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_so'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?> </td><td><?php echo $data['rcp_so'];?></td>
			  		</tr>
			
						<?php } 
 ?> 
		</tbody>
	</table>
	</fieldset>
</div>
</body>
</html>