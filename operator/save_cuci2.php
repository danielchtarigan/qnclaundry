<?php
//Koneksi database
include 'header.php';
include '../config.php';

$no_nota = $_GET['no_nota'];
$id_cs   = $_GET['id_cs'];






if( !empty ( $no_nota ) ){

	//Query sql untuk mencari data
	$sql = mysqli_query($con,"SELECT * From reception where no_nota = '$no_nota' and id_customer='$id_cs' and cuci=false LIMIT 1");

	//Cek apakah data ditemukan
	$row = mysqli_num_rows( $sql );

	//Jika ditemukan maka tampilkan
	if( $row != 0 ){

		while( $data = mysqli_fetch_assoc( $sql ) )
		{

			?><br/>
			<div  class="container-fluid" style="width:500px;
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
   margin-bottom: 100px;
   ">
			<script>
					function showDiv()
					{
						document.getElementById('rincianspk').style.display = "block";
					}

				</script>

				<script>

					function kirim_form()
					{

						$('#pesan_kirim').html('Loading ...');
						$('#pesan_kirim').slideDown('slow');

						var no_nota   = $('#no_nota').val();
						var jumlah1 = $('#jumlah1').val();
						var jumlah = $('#jumlah').val();

						var ket = $('#ket').val();
						var no_mesin = $('#no_mesin').val();
						if(jumlah1 == '' || no_mesin == '')
						{
							alert("Tolong Jumlah ama no mesin di isi");
							exit();
						}
						if(jumlah1 != jumlah )
						{
							alert("jumlah tidak sama cek cuciannya. kalo gak sesuai di rijek");
							exit();
						} else
						{




							$.ajax(
								{
									//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
									url      : 'savecuci.php',
									type     : 'POST',
									dataType : 'html',
									data     : 'no_nota='+no_nota+'&jumlah1='+jumlah1+'&ket='+ket+'&no_mesin='+no_mesin,
									success  : function(respons)
									{
										$('#pesan_kirim').html(respons);
										$("#form-input")[0].reset();
										$("#no_nota").val('');
										$("#nama_customer").val('');
										$("#jumlah").val('');
									},
								})
						}
					}
				</script>
				<script type="text/javascript">
					$(function()
						{
							$("#jumlah1").focus();
						});
				</script>
				<script>
					function cek_jumlah()
					{
						var jumlah1 = $('#jumlah1').val();
						var jumlah = $('#jumlah').val();
						if(jumlah1 != jumlah )
						{
							alert("jumlah tidak sama cek cuciannya. kalo gak sesuai di rijek");
							$('#rincianspk').show();
							$("#add").attr("disabled","");

						}else
						{
							$('#rincianspk').hide();
							$("#add").removeAttr('disabled','');
						}

					}




				</script>
				<form method="post" action="" id="form-input" class="form-horizontal">
					<div id="pesan_kirim" style="display:none">
					</div>
					<div class="form-group">

						<label class="control-label col-xs-3" for="no_nota">
							No Nota
						</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="no_nota" id="no_nota" required="true" value="<?php echo $data['no_nota']; ?>" readonly="true" >
						</div>
					</div>

					<div class="form-group" >
						<label class="control-label col-xs-3" for="nama_customer">
							Nama Customer
						</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-4">
							<input type="hidden" class="form-control" name="jumlah" id="jumlah" required="true" value="<?php echo $data['jumlah']; ?>" readonly="true" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="ket">
							Keterangan
						</label>
						<div class="col-xs-5">
							<textarea type="text" class="form-control" name="ket" id="ket" required="true" value="<?php echo $data['ket']; ?>" readonly="true" >
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label  class="control-label col-xs-3 col-xs-3" for="jumlah1">
							Jumlah
						</label>
						<div class="col-xs-4">
							<input type="number" class="form-control" name="jumlah1" id="jumlah1" onblur="cek_jumlah();" required="true" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="no_mesin">
							No Mesin
						</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="no_mesin" id="no_mesin" required="true">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="ket">
							Keterangan
						</label>
						<div class="col-xs-4">
							<textarea type="text" class="form-control" name="ket" id="ket">
							</textarea>
						</div>
					</div>


					<?php
					
					$allowed = true;
					$tglInput = date('Y-m-d', strtotime($data['tgl_input']));
					if ($data['express']==0 && $data['priority']==0) {
							$sqlbelumdiproses = mysqli_query($con,"SELECT no_nota,tgl_input,nama_customer FROM reception WHERE (DATE(tgl_input) < '".$tglInput."') and nama_outlet<>'mojokerto' and cuci=false and pengering=false and setrika=false and spk=true and packing=false and kembali=false and ambil=false and jenis='".$data['jenis']."' and rijeck=false and workshop='$workshop' and cara_bayar<>'Void' and cara_bayar<>'Reject' ORDER BY tgl_input ASC");
							if (mysqli_num_rows($sqlbelumdiproses)>0) {
								$allowed = false;
							}
					}
					if ($allowed) { ?>
					<div class="form-group">
						<input type="button" value="Simpan" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
					</div>
					<?php } else {
						if ($data['jenis']=='k') $type = 'KILOAN';
						else $type = 'POTONGAN';
						echo '<p style="color:red"><b>WAJIB MENCUCI ANTRIAN '.$type.' DARI TANGGAL LEBIH TUA TERLEBIH DAHULU YAITU:</b><br>';
						while ($data = mysqli_fetch_array($sqlbelumdiproses))
						{
							echo "$data[tgl_input] - $data[no_nota] - $data[nama_customer]<br>";
						}
						echo '</p>';
					} ?>

				</form>
			<div id="rincianspk" style="display: none">

<div class="content" id="content">
<table border="1">
			rincian
				<?php

			$sql2 = mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");

			while($data = mysqli_fetch_array($sql2))
			{
				?>
				<tr>

					<td>
						<?php echo $data['jumlah'];?>
					</td>

					<td>
						<?php echo $data['item'];?>
					</td>

					<td>
						<?php echo $data['total'];?>
					</td>

				</tr>

				<?php
			}
			?>
			</table>
						<table border="1">
			rincian spk
				<?php

			$sql2 = mysqli_query($con,"SELECT * FROM detail_spk WHERE no_nota= '$no_nota'");

			while($data = mysqli_fetch_array($sql2))
			{
				?>
				<tr>

					<td>
						<?php echo $data['jenis_item'];?>
					</td>

					<td>
						<?php echo $data['jumlah'];?>
					</td>
				</tr>

				<?php
			}
			?>
			</table>
</div>


				<script type="text/javascript">
					function printout()
					{
						var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
						newWindow.document.write(document.getElementById("pesan_kirim").innerHTML);
						newWindow.print();

					}
				</script>
			</div>
			</div>

			<?php
		}
	}
	else
	{
		$sql1 = mysqli_query($con,"SELECT * From reception where no_nota = '$no_nota' LIMIT 1");
		$data1= mysqli_fetch_assoc( $sql1 );
		echo "Tidak menemukan data bu <br>";
		echo 'cuci :'.$data1['op_cuci']."<br>";
		echo 'tgl Cuci :'.$data1['tgl_cuci'];


	}

}
