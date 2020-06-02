<?php
include 'header.php';
include '../config.php';

?>

<?php 
$op=$_SESSION['user_id']; ?>
<style type="text/css">
	a
	{
		color:#FF0000;
	}
</style>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#tbl_member td a.delete').click(function()
		{
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "POST",
					   url: "dell.php",
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
		$('table#tbl_member tr:odd').css('background',' #FFFFFF');
	});
	
</script>

<script>
		        var id;
                var nama_customer;
    $(function(){
    	 $('#tampil').load("pk.php","op=daftar_lgn");
    				 $('#tampil2').load("pk.php","op=dt_customer");
                                  
     	$("#add").click(function()
     	{
  					   
                        id=$("#id").val();
                        nama_customer=$("#nama_customer").val();
                       
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=up_cst&id="+id,
                            cache:false,
                            success:function(msg)
                            {
                            	
                               
                                $("#lgn").load("pk.php","op=daftar_lgn");
                       			$("#cst").load("pk.php","op=dt_customer");
                       			$("#tambah-data").modal('hide');
                       			      
     
                            }
                        })
                    })
                    $("#kurang").click(function()
     	{
  					   
                        id_cs=$("#id_cs").val();
                        jumlah=$("#jumlah").val();
                        no_nota=$("#no_nota").val();
						sisa= $("#sisa").val();
						c = parseInt(sisa)- parseInt(jumlah)
					    $("#total").val(c);
						total= $("#total").val();
						
								
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=kurang&id_cs="+id_cs+"&jumlah="+jumlah+"&no_nota="+no_nota+"&total="+total,
                            cache:false,
                            success:function(msg)
                            {
                                $('#status').html(msg);
                                $("#loading").hide();
                                $("#barang").load("pk.php","op=dt_lgn&id_cs="+id_cs);
                                $("#customer").load("pk.php","op=customer&id_cs="+id_cs);
                            }
                        })
                    })
                    
 });
                    
     	
     </script>
<script>
$(function(){

		$('#tambah-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			
			var id 	= div.data('id');
			var nama_customer 	= div.data('nama_customer');
			var zona 	= div.data('zona');
			var no_telp 	= div.data('no_telp');
			var alamat 	= div.data('alamat');

			var modal 	= $(this)

			// Isi nilai pada field
		
			modal.find('#id').attr("value",id);
			modal.find('#nama_customer').attr("value",nama_customer);
			modal.find('#zona').attr("value",zona);
			modal.find('#alamat').attr("value",alamat);
			modal.find('#no_telp').attr("value",no_telp);


		});

	});

</script>

<script>
$(function(){
	//ketika tombol update di klik
           $("#pilih").click(function(){
           var id = $('#id').val();
 
           //kode 1
           var request = $.ajax ({
               url : "tr_lgn.php",
               data : "id="+id,
               type : "GET",
               dataType: "html"
           });
        //Jika pencarian selesai
           request.done(function(output) {
               //Tampilkan hasil pencarian pada tag div dengan id hasil-cari
              
                });
 
    });
});
</script>
	
	
<div class="container-container">
<div class="col-md-6 col-md-offset-3" >
<fieldset>
<legend align="center"><strong>Daftar Customer 	Member</strong></legend>
<div id="member">
	<table id="tbl_member" class="display">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Alamat</th>
			<th>No Telp</th>
			<th>Poin</th>
						<th>tgl join</th>

			<th>tgl akhir</th>


			<th>Pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM customer where member=1";
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
					?>
					
				<tr id="<?php echo $data['id']; ?>">
				<td>
				<?php echo $data['nama_customer']; ?></td>
				<td><?php echo $data['alamat']; ?></td>
				<td><?php echo $data['no_telp']; ?></td>
				<td><?php echo $data['poin']; ?></td>
				<td><?php echo $data['tgl_join']; ?></td>
				<td><?php echo $data['tgl_akhir']; ?></td>
				
				<td align="center">
				
				<a class="btn btn-sm btn-danger" href="tr_member.php?id=<?php echo $data['id']; ?>">pilih</a>
				</td>
				</tr>
				<?php } 
				?>
		</tbody>
		</table>
	
	
	
</div>
</fieldset>
</div>

</div>
<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="" class="contac" name="contact">
				<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="nama_customer">nama_customer</label>
						      <input type="text" name="nama_customer" id="nama_customer" class="form-control" placeholder="Masukkan nama_customer">
						    </div>

						    <div class="form-group">
						      <label for="nama">Alamat</label>
						      <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan Nama">
						    </div>

						    <div class="form-group">
						      <label for="no_telp">No Telp</label>
						      <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="Masukkan password">
						    </div>
						  </fieldset>

						
					</div>

					<div class="modal-footer">
						<button class="btn btn-success" id="add" class="btn">Tambah</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
<script>
$(document).ready(function() { 

$('#tbl_member').dataTable();

});
</script>	
		
		
	


