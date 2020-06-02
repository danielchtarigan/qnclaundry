<?php
function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
include '../config.php';
date_default_timezone_set('Asia/Makassar');
/*$brg=mysqli_query($con,"select * from reception WHERE  id_customer='$id_cs' and lunas=false and datediff(current_date(),DATE_FORMAT(tgl_input, '%Y-%m-%d'))<='1' and cuci=false and packing=false ");*/
	$id_cs=$_GET['id_cs'];
	$brg=mysqli_query($con,"select * from reception WHERE  id_customer='$id_cs' and lunas=false and cuci=false and packing=false and setrika=false");
	
   $sql3=mysqli_query($con,"SELECT sum(total_bayar) as total FROM reception WHERE id_customer='$id_cs' and lunas=false");
$s1=mysqli_fetch_array($sql3);
$tt3=rupiah($s1['total']);
    echo "<thead>
            <tr>
            <td>tgl</td>
            	<td>No Nota</td>
               
                
                <td>total</td>
                 <td>aksi</td>
              
             </tr>
             </thead>";
    while($r=mysqli_fetch_array($brg)){
    	$tt=rupiah($r['total_bayar']);
    	echo "<tr id='$r[no_nota]' >
    	<td>$r[tgl_input]</td>
        		<td>$r[no_nota]</td>
                
                <td>$tt</td>
                <td><a class='hapusorder' id='$r[no_nota]' style='cursor: pointer;'>void order</a></td>
             
            </tr>";
    }
    
    
    
    
    
    
    
    
    
    
?>
<script>
	 $(function () {
//Box Konfirmasi Hapus
            $('#konfirm-box1').dialog({
                modal: true,
                autoOpen: false,
                show: "Bounce",
                hide: "explode",
                title: "Konfirmasi",
                buttons: {
  
                    "Ya": function () {
  jQuery.ajax({
  type: "POST",
  url: "dell_order_jual.php",
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
            $('.hapusorder').click(function () {
                $('#konfirm-box1').dialog("open");
 //ambil nomor id
                id = $(this).attr('id');
            });
        });
</script>    