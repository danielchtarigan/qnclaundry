<html>
<head>
<?php
include "../config.php";
require "header.php";
$us=$_SESSION['user_id'];
$ws=$_SESSION['workshop'];

?>
</head>
<body>
<div  class="container-fluid" style="width:1200px;
   margin:0 auto;
   position:relative;
   border:3px solid rgba(0,0,0,0);
   -webkit-border-radius:5px;
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
 <fieldset>
<legend align="center"><strong>BELUM SETRIKA KILOAN</strong></legend>
<table id="setrika" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
      <th>Express</th>
      <th>Priority</th>
			<th>Cuci</th>
      <th>Pengering</th>
			<th>Proses setrika</th>
			<th>pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception natural join control where setrika=false and pengering=true and packing=false and kembali=false and ambil=false and jenis='k' and nama_outlet<>'mojokerto' AND workshop='$ws' ORDER BY express desc, priority desc, tgl_input asc ";//LIMIT 7" ;
			$tampil = mysqli_query($con, $query);

			$no = 1;
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						<td><?php echo $no ;?> </td>
						<td><?php echo $data['tgl_input'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
            <td><?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express';				 ?></td>
            <td><?php if ($data['priority']==1) echo 'Priority'; ?></td>
						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?>


                                                </td>
<td><?php		       if($data['tgl_pengering']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_pengering'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?>


                                                </td>
			  <td>
			  <?php

			  $sql=$con->query("select no_nota from setrika_sementara WHERE no_nota = '$data[no_nota]' LIMIT 1");
			$row = mysqli_num_rows( $sql );
if ( $row != 0 ) {
	echo 'sementara';
	}else{
		echo '';

	}
					?>	</td>
			  <td align="center">
			<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="setrika_sementara.php?no_nota=<?php echo $data['no_nota']; ?>&&id_cs=<?php echo $data['id_customer']; ?>&&jenis=<?php echo 'kiloan' ?>">pilih</a>
				</td>

				</tr>

						<?php $no++; }
 ?>
		</tbody>
	</table>





</fieldset>
</div>
<div  class="container-fluid" style="width:800px;
   margin:0 auto;
   position:relative;
   border:3px solid rgba(0,0,0,0);
   -webkit-border-radius:5px;
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
<fieldset>
<legend align="center"><strong>Sementara Di Setrika</strong></legend>
<table id="selesaisetrika" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tgl Setrika</th>
			<th>No Nota</th>
			<th>Setrika</th>

			<th>Nama Customer</th>
			<th>Pilih</th>

		</tr>
		</thead>
		<tbody>
			<?php

			$query = "SELECT * FROM setrika_sementara where status=false" ;
			$tampil = mysqli_query($con, $query);

			$no = 1;
			while($data = mysqli_fetch_array($tampil)){?>
				<tr id="<?php echo $data['id']?>">
						<td><?php echo $no ;?> </td>
						<td><?php echo $data['tgl_setrika'];?></td>

						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['user_setrika'];?></td>

						<td><?php

					$sql4=mysqli_query($con,"SELECT nama_customer FROM reception WHERE no_nota='$data[no_nota]'");
$s2=mysqli_fetch_array($sql4);
$nama=$s2['nama_customer'];
echo $nama ;
					?>	</td>
			 <td align="center">

				<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="selesai_setrika.php?no_nota=<?php echo $data['no_nota']; ?>">Selesai di setrika</a>
				</td>

				</tr>

						<?php $no++; }
 ?>
		</tbody>
	</table>




</fieldset>
</div>
<div  class="container-fluid" style="width:1200px;
   margin:0 auto;
   position:relative;
   border:3px solid rgba(0,0,0,0);
   -webkit-border-radius:5px;
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">

    <fieldset>
<legend align="center" style="background-color: #04fb30"><strong>BELUM SETRIKA Potongan</strong></legend>
<table id="potongan" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Cuci</th>
			<th>Proses setrika</th>
			<th>pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception natural join control where setrika=false and cuci=true and packing=false and kembali=false and ambil=false and jenis='p' and nama_outlet<>'mojokerto' AND workshop='$ws' ORDER BY tgl_cuci asc " ;
			$tampil = mysqli_query($con, $query);

			$no = 1;
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						<td><?php echo $no ;?> </td>
						<td><?php echo $data['tgl_input'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?>


                                                </td>
			  <td>
			  <?php

			  $sql=$con->query("select no_nota from setrika_sementara WHERE no_nota = '$data[no_nota]' LIMIT 1");
			$row = mysqli_num_rows( $sql );
if ( $row != 0 ) {
	echo 'sementara';
	}else{
		echo '';

	}
					?>	</td>
			  <td align="center">
			<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="setrika_sementara.php?no_nota=<?php echo $data['no_nota']; ?>&&id_cs=<?php echo $data['id_customer']; ?>&&jenis=<?php echo 'potongan' ?>">pilih</a>
				</td>

				</tr>

						<?php $no++; }
 ?>
		</tbody>
	</table>





</fieldset>

   </div>



</body>


<script type="text/javascript">
		$(document).ready(function(){
			$('#setrika').dataTable();
			$('#potongan').dataTable();
			$('#selesaisetrika').dataTable();


		});
		</script>
<script>
	function cek(){
	$('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');

    var no_nota   = $('#no_nota').val();
    var jumlah1 = $('#jumlah1').val();
    var ket1 =$('#ket1').val();
    var harga =$('#harga').val();
    var jenis =$('#jenis').val();
    var nama_outlet =$('#nama_outlet').val();



			if ( jumlah1 == "" ){
				alert("Jumlah Masih Kosong");
				$("#jumlah1").focus();
				return false;
			}
			if ( harga == "" ){
				alert("harga Masih Kosong");
				$("#harga").focus();
				return false;
			}




    $.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'save_packer.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&jumlah1='+jumlah1+'&ket1='+ket1+'&jenis='+jenis+'&harga='+harga+'&nama_outlet='+nama_outlet,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
            $("#form-input2")[0].reset();
             $("#form-input1")[0].reset();
            $("#no_nota").val('');
            $("#nama_customer").val('');
            $("#jumlah").val('');
            $("#ket1").val('');
            $("#jenis").val('')
            $("#nama_outlet").val('')
             $('#dataexpress').load('daftar_express.php');
		 $('#belum').load('daftar_belum.php');
		$('#rincianpacking1').load('d_packing.php');
		 $('#pesan_kirim').hide();
            printout();
        },
    })
}

</script>

</html>
