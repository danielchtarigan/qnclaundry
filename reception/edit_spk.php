<?php

include 'header.php';
include '../config.php';

$no_nota=$_GET['no_nota'];
$sql=$con->query("select * from reception WHERE no_nota = '$no_nota' limit 1 ");
$r = $sql->fetch_assoc();

?>
<head>


</head>
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
                         jenis_item=$("#nama_item1").val()+" "+$("#ket").val()+" "+$("#wn").val()+" "+$("#mt").val();
                        
						
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
  $('input:radio[name="motif"]').change(function() {
        q=$(this).val() ;
       $("#mt").val(q);
    });
$('input:radio[name="warna"]').change(function() {
        q=$(this).val() ;
       $("#wn").val(q);
    });     
                    
                                        
               });
       </script>
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
						     <div class="row">
       
        <div class="col-sm-12">
            <div  >
                <label >
                    <input type="radio" id="q128" name="motif" value="kotak" /> kotak
                </label> 
                <label >
                    <input type="radio" id="q131" name="motif" value="garishorisontal" /> garis horisontal --
                </label> 
                <label >
                    <input type="radio" id="q132" name="motif" value="garisvertical" /> garis vertical ||
                        
                </label>
                <label >
                    <input type="radio" id="q132" name="motif" value="bunga2" /> bunga bunga
                        
                </label>
                <label >
                    <input type="radio" id="q132" name="motif" value="bulat2" /> bulat bulat OO
                        
                </label>
                                <label >
                    <input type="radio" id="q131" name="motif" value="polos" /> polos
                     
                </label> 
                <label >
                   <input type="text" id="mt" name="mt" class="form-control" placeholder="no nota">
                        
                </label>

            </div>
        </div>
          <div class="col-sm-12">
            <div  >
                <label >
                    <input type="radio" id="q128" name="warna" value="hitam" /> <font color="#000000">hitam</font>
                </label> 
                <label >
                    <input type="radio" id="q131" name="warna" value="putih" /> Putih
                </label>
                <label >
                    <input type="radio" id="q128" name="warna" value="merah" /> <font color="#ff0000">merah</font>
                </label> 
                <label >
                    <input type="radio" id="q131" name="warna" value="kuning" /> <font color="#fff428">kuning</font>
                </label>
                <label >
                    <input type="radio" id="q131" name="warna" value="hijau" /> <font color="#39ff00">hijau</font>
                </label>
                
                
                 
                <label >
                    <input type="radio" id="q132" name="warna" value="biru" /> <font color="#0121fe">biru</font>
                      <input type="text" id="wn" name="wn" class="form-control" placeholder="no nota">
                </label>
            </div>
        </div>

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
if(id == '132' || id=='128' || id == '129' || id=='131' || id == '104' || id=='94' || id == '111'){
				modal.find('#jumlah').attr("readonly",false)
			}else{
				modal.find('#jumlah').attr("readonly",true)

			}


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
