<!DOCTYPE html>
<html lang="en">

<head>
<?php

include '../../../config.php';
$no_nota=$_GET['no_nota'];
$sql=$con->query("select * from reception WHERE no_nota = '$no_nota' limit 1 ");
$r = $sql->fetch_assoc();

?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	<link href="../../dist/css/timeline.css" rel="stylesheet">
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
<div class="col-md-4 col-md-offset-0">
<fieldset>
<legend align="center" ><strong>SPK</strong></legend>    
     
     	<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
      	<input type="hidden" class="form-control" name="no_nota1" id="no_nota1" required="true" value="<?php echo $r['no_nota']; ?>"  >
      	<div class="row featurette">
        <div class="col-md-7 col-md-offset-1" >
        <div id="konfirm-box"> Apakah Anda yakin akan menghapus ini?</div>
       	<table id="spk" class="display">
		<thead>
		<tr>
			<th hidden="true"></th>			
		</tr>
		</thead>
		<tbody>
     		<?php $sql = $con->query("SELECT * FROM spk_item"); ?>
			<?php while ( $d = $sql->fetch_assoc() ) { ?>
					<tr><td>
									<a href="javascript:;"
									data-id="<?php echo $d['id'] ?>"
									data-nama_item1="<?php echo $d['nama_item'] ?>"
									data-toggle="modal" data-target="#edit-data"> <?php echo $d['nama_item'] ?></a>
									
					
				<?php } ?>
</td></tr>
		</tbody>
	</table>
			

	                  
  		</div><!-- /.col-lg-4 -->
  	

         
        </div>	
        </fieldset>
       </div>
        
       
<fieldset>
<legend align="center" ><strong>EDIT SPK</strong></legend>
<label>Nama Customer : <?php echo $r['nama_customer'] ?> ||</label>
<label>No Nota :<?php echo $r['no_nota'] ?></label>
 
<table id="rincian" class="table table-bordered">
</table>
<button id="selesai" class="btn btn-md btn-danger">Selesai</button>
  <span id="status"></span>
<button id="reprint" class="btn btn-md btn-info">Reprint</button>
  <span id="statusreprint"></span>


</fieldset>
</div>



  		


          
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="../../../lib/js/jquery-2.1.4.min.js"></script>
    <script src="../../../lib/js/bootstrap.min.js"></script>
    <script src="../../dist/js/metisMenu.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
 
</body>

<div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<input type="hidden" name="id" id="id">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Item
					</div>
					<div class="modal-body">
						  <fieldset>
 						<div class="form-group">
						      <label  class="control-label col-xs-3" for="nama_item1">Item</label>
						    <div class="col-xs-4" >
						       <input type="text"disabled="true" id="nama_item1" name="nama_item1" class="form-control" placeholder="item"></div>
<input type="text" id="ket" name="ket" class="form-control" placeholder="ket,warna"></div><br>						    <div class="form-group">
						      <label  class="control-label col-xs-3" for="jumlah">Jumlah</label>
						       <div class="col-xs-4" >
						      <input type="text" id="jumlah" autocomplete="off"  name="jumlah" class="form-control" placeholder="Jumlah" value="1" autofocus />
						      <input type="hidden" id="no_nota1" name="no_nota1" class="form-control" placeholder="no nota">
						    </div></div>
						    </fieldset>
					</div>
					<div class="modal-footer">
					  <button id="simpanspk" class="btn btn-md btn-danger">Simpan</button>
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

			

			</div>
		</div>
	</div>



	
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
<script type="text/javascript">
    function printout() {

    var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("status").innerHTML);
    newWindow.print();
    
}
function printout1() {

    var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("statusreprint").innerHTML);
    newWindow.print();
    
}
</script>

  <script>       
               var no_nota;
               var id_cs;
               var jumlah;
               var total;
    $(function(){
                    id_cs=$("#id_cs").val();
                    no_nota=$("#no_nota1").val();
	                $("#customer").load("pk.php","op=customerspk&id_cs="+id_cs);
                    $("#rincian").load("rincian_spk.php","no_nota="+no_nota);
                   
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
                            url:"pk.php",
                            data:"op=tambahspk&jumlah="+jumlah+"&no_nota="+no_nota+"&jenis_item="+jenis_item,
                            success:function(msg)
                 { 
                 $('#status').html(msg);                              
                 $("#customer").load("pk.php","op=customerspk&id_cs="+id_cs);                                   
             	 $("#rincian").load("rincian_spk.php","no_nota="+no_nota);
                 $('#status').hide();
                 $("#edit-data").modal('hide');
                 $("#no_nota").val("");
                 $("#ket").val("");
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
                    

                  $("#selesai").click(function()
     				{
  					   
                        no_nota=$("#no_nota1").val();
                        id_cs=$("#id_cs").val();
						
						$.ajax({
                            url:"simpan_edit_spk.php",
                            data:"no_nota="+no_nota+"&id_cs="+id_cs,
                            cache:false,
                            success:function(msg)
                            {
                                $('#status').html(msg);          
                                $("#no_nota").val("");
                                $("#ket").val("");
                                $("#customer").load("pk.php","op=customerspk&id_cs="+id_cs);                        
    			  				$("#rincian").load("rincian_spk.php","no_nota="+no_nota);
                                $('#status').hide();
                              	$("#edit-data").modal('hide');
                             	printout();
                             	window.location='lap_spk.php';
                             }
                        })
                    })                    

                    
                                        
               });
       </script>

</html>
