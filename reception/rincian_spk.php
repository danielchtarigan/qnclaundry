<?php
include '../config.php';
$no_nota=$_GET['no_nota'];
$brg=mysqli_query($con,"select * from detail_spk WHERE no_nota='$no_nota'");
$sql3=mysqli_query($con,"SELECT sum(jumlah) as jumlah FROM detail_spk WHERE no_nota='$no_nota'");
$s1=mysqli_fetch_array($sql3);
$hr=$s1['jumlah'];
    echo "<thead>
            <tr>
            	<td>No Nota</td>
                <td>Item</td>
                <td>Jumlah</td>
                <td>Hapus</td>                
               </tr>
        </thead>";
    while($r=mysqli_fetch_array($brg)){    	
    	echo "<tr id='$r[id]' >
        	<td>$r[no_nota]</td>
            <td>$r[jenis_item]</td>
            <td>$r[jumlah]</td>
            <td><a class='hapus' id='$r[id]' style='cursor: pointer;'>hapus</a></td>
            </tr>";
    }
echo "<tfoot>
	  <tr>
	  <td>Total</td>
	  <td></td>
	  <td> $hr </td> 
      </tr>
      </tfoot>";
          ?>
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
  url: "del_detail_spk.php",
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