<?php
include 'header.php';
include '../config.php';
 function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
?>

<?php 
$op=$_SESSION['user_id']; ?>


<script>
		        var id;
                var nama_customer;
    $(function(){
    	                          
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
<legend align="center"><strong>Daftar Customer Langganan</strong></legend> 
<table id="tbl_tampil" class="display">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Alamat</th>
			<th>No Telp</th>
			<th>Kiloan</th>
            <th>Potongan</th>
			<th>Pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT nama_customer,alamat,no_telp,id, sisa_kuota FROM customer where lgn=1";
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				 $langganan = mysqli_query($con, "select *from langganan where id_customer='$data[id]' ");
            $ql = mysqli_fetch_array($langganan);
				?>
				<tr>
				<td>
				<?php echo $data['nama_customer']; ?></td>
				<td><?php echo $data['alamat']; ?></td>
				<td><?php echo $data['no_telp']; ?></td>
				<td><?php echo $ql['kilo_cks'].' Kg' ?></td>
                <td><?php echo rupiah ($ql['potongan']) ?></td>
				<td align="center">
				<a class="btn btn-sm btn-danger" href="tr_lgn.php?id=<?php echo $data['id']; ?>">pilih</a>
				</td>
				</tr>
				<?php } 
				?>
		</tbody>
		</table>

</fieldset>
</div>
<div class="divider"></div>
<div class="col-md-6 col-md-offset-3" >
</div>
</div>

<script> $(document).ready(function() { 
$('#tbl_tampil').dataTable();

} );
	</script>
		
		
	


