<!DOCTYPE html>
<html lang="en">
<?php
include '../../../config.php';

$no_nota=$_GET['no_nota'];
$sql=$con->query("select * from reception WHERE no_nota = '$no_nota' limit 1 ");
$r = $sql->fetch_assoc();



function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
?>
<head>



  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery.dataTables_themeroller.css" />
<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../../../lib/css/dataTables.tableTools.css">
<link rel="stylesheet" type="text/css" href="../../../lib/css//dataTables.tableTools.css">




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


 <div id="wrapper">

        <!-- Navigation -->
     
          <?php 
             include 'nav.php';
           ?>
     
        <div id="page-wrapper">
       
       	<div class="row featurette"> 
       	<div class="col-md-4 col-md-offset-0" >
       	
       	
       	
       	</div>
       	</div>
		       	<div class="row featurette"> 
		            <div class="col-md-4 col-md-offset-0" >
		          <fieldset>
<span id="d_spk"></span>
<legend align="center" ><strong>SPK</strong></legend>    
     
     	<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
      	<input type="hidden" class="form-control" name="no_nota1" id="no_nota1" required="true" value="<?php echo $r['no_nota']; ?>"  >
      	
        <label>Nama Customer : <?php echo $r['nama_customer'] ?> ||</label>
		<label>No Nota :<?php echo $r['no_nota'] ?></label>
       	<table id="semua" class="display">
		<thead>
		<tr>
			
			
		</tr>
		</thead>
		<tbody>
			<?php
			$sql1=$con->query("select * from detail_penjualan WHERE no_nota = '$no_nota'");
			$no = 1;
			while($data =$sql1->fetch_array()){
                        ?>
				<tr>
						
						<td><?php echo $data['item'] ; ?></td>
						
						
</tr>
							<?php $no++; } 
 ?>   
		</tbody>
	</table>
       
			

	                  
  		
        </fieldset>
		          
		            </div>
		              <div class="col-md-4 col-md-offset-0" >
		              <fieldset>
<legend align="center" ><strong>Rincian</strong></legend>
 
 
 <table id="rincian" class="table table-bordered">
</table>

  <span id="status"></span>
 <button id="reprint" class="btn btn-md btn-info">Reprint</button>
  <span id="statusreprint"></span>
</fieldset>
		              </div>
		            
		       </div>     





  		


          
        </div>
        <!-- /#page-wrapper -->

    </div>











  




	
	
 

</body>



	<script src="../../../lib/js/jquery-2.1.3.min.js"></script>
    <script src="../../../lib/js/bootstrap.min.js"></script>
    <script src="../../dist/js/metisMenu.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>

<script type="text/javascript" language="javascript" src="../../../lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="../../../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../../../lib/js/dataTables.tableTools.js"></script>

           <script type="text/javascript">
     function printout() {

    var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("status").innerHTML);
    newWindow.print();
    
}
    </script>
<script type="text/javascript">
     function printout1() {

    var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("statusreprint").innerHTML);
    newWindow.print();
    
}
    </script>
  <script>
     
        //mendeksripsikan variabel yang akan digunakan
               
                var no_nota;
               var id_cs;
                var jumlah;
                var total;
    $(function(){
                    id_cs=$("#id_cs").val();
                    no_nota=$("#no_nota1").val();
                    $("#rincian").load("../fungsi/aksi.php","op=rincian_spk&id_cs="+id_cs+"&no_nota="+no_nota);
                   
                                      
     	$("#simpanspk").click(function()
     	{
  					   
                         jumlah=$("#jumlah").val();
                        no_nota=$("#no_nota1").val();
                        jenis_item=$("#nama_item1").val()+" "+$("#ket").val();
                        
						
									if ( jumlah == "" ){
				alert("Jumlah Masih Kosong");
				$("#jumlah").focus();
				return false;
			} else if ( no_nota == "" ){
				alert("No Masih Kosong");
				$("#no_nota").focus();
				return false;
			}$.ajax({
                            url:"../fungsi/aksi.php",
                            data:"op=tambahspk&jumlah="+jumlah+"&no_nota="+no_nota+"&jenis_item="+jenis_item,
                            cache:false,
                            success:function(msg)
                            {
                                $('#d_spk').html(msg);
                               
                              
                   
                    $("#rincian").load("../fungsi/aksi.php","op=rincian_spk&id_cs="+id_cs+"&no_nota="+no_nota);       
                               $("#edit-data").modal('hide');
                               $("#no_nota").val("");
                               $("#jumlah").val("1");
                               $("#ket").val("");
                                printout1();
                               

                                
                                
                                
                            }
                        })
                    })
                $("#selesai").click(function()
     	{
  					   
                        no_nota=$("#no_nota1").val();
                         id_cs=$("#id_cs").val();
						
						$.ajax({
                            url:"../fungsi/aksi.php",
                            data:"op=selesaispk&no_nota="+no_nota+"&id_cs="+id_cs,
                            cache:false,
                            success:function(msg)
                            {
                                $('#status').html(msg);
                               
                                $("#no_nota").val("");
                                $("#jumlah").val("");
                                $("#ket").val("");
                               $("#rincian").load("../fungsi/aksi.php","op=rincian_spk&id_cs="+id_cs+"&no_nota="+no_nota);       
                   				
                                $('#status').hide();
                              	$("#edit-data").modal('hide');
                             	 printout();
                             	   window.location='belum_spk.php';
                                
                                
                            }
                        })
                    })
                    
               
          $("#reprint").click(function()
     				{
  					   
                        no_nota=$("#no_nota1").val();
                        id_cs=$("#id_cs").val();
						
						$.ajax
						({
                            url:"reprint_spk.php",
                            data:"no_nota="+no_nota+"&id_cs="+id_cs,
                            success:function(msg)
                            {
                            	$('#statusreprint').html(msg);
                    	        $('#statusreprint').hide();
                             	printout1();
                            }
                        })
                    	
                    	})            
                   
                    
 });
 
                    
     	
     </script>
<script>
$(function(){

		$('#edit-data').on('show.bs.modal', function (event) {
								// Isi nilai pada field
	
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var no_nota = $('#no_nota1').val();
 			var jumlah =$('#jumlah').val();
           	var id 	= div.data('id');
			var nama_item1 	= div.data('nama_item1');
			
			
			var modal 	= $(this)
			
	
			// Isi nilai pada field
		
			modal.find('#id').attr("value",id);
			modal.find('#nama_item1').attr("value",nama_item1);
			modal.find('#no_nota1').attr("value",no_nota);


		});
		

	});

</script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#spk').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,
				"scrollY": 300,
			    "paging": false,
			    "info": false
				
			});
			
	});
</script>
</html>
