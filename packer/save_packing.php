
<?php
include 'header.php';
include '../config.php';

$no_nota = $_GET['no_nota'];
$id_cs   = $_GET['id_cs'];

if( !empty ( $no_nota ) )
{
	$sql = mysqli_query($con,"SELECT * From reception where no_nota = '$no_nota' and id_customer='$id_cs' and packing=false LIMIT 1");

	$row = mysqli_num_rows( $sql );

	//Jika ditemukan maka tampilkan
	if( $row != 0 ){

		while( $data = mysqli_fetch_assoc( $sql ) ){
			if($data['jenis'] == 'k')
			{
				$jenis = "kiloan";
			}
			else
			{
				$jenis = "potongan";
			}
			?>
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
				<script>
					function kirim_form()
					{
						$('#pesan_kirim').html('Loading ...');
						$('#pesan_kirim').slideDown('slow');

						var no_nota   = $('#no_nota').val();
						var jumlah1 = $('#jumlah1').val();
						var ket1 =$('#ket1').val();
						var harga =$('#harga').val();
						var jenis =$('#jenis').val();
						var nama_outlet =$('#nama_outlet').val();



						if ( jumlah1 == "" )
						{
							alert("Jumlah Masih Kosong");
							$("#jumlah1").focus();
							return false;
						}
						if ( harga == "" )
						{
							alert("harga Masih Kosong");
							$("#harga").focus();
							return false;
						}




						$.ajax(
							{
								//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
								url      : 'save_packer.php',
								type     : 'POST',
								dataType : 'html',
								data     : 'no_nota='+no_nota+'&jumlah1='+jumlah1+'&ket1='+ket1+'&jenis='+jenis+'&harga='+harga+'&nama_outlet='+nama_outlet,
								success  : function(respons)
								{
									$('#pesan_kirim').html(respons);
									$("#form-input2")[0].reset();
									$("#form-input1")[0].reset();
									$("#no_nota").val('');
									$("#nama_customer").val('');
									$("#jumlah").val('');
									$("#ket1").val('');
									$("#jenis").val('')
									$("#nama_outlet").val('')
									$('#pesan_kirim').hide();
									printout();
									window.location='antrian_packing.php';
								},
							})
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

				<form method="post" action="" id="form-input2" class="form-horizontal">
					<div class="form-group">
						<div id="pesan_kirim" style="display:none">
						</div>
						<div class="form-group" >
							<label class="control-label col-xs-3" for="nama_customer">
								Nama Outlet
							</label>
							<div class="col-xs-4">
								<input type="text" class="form-control" name="nama_outlet" id="nama_outlet" required="true" value="<?php echo $data['nama_outlet']; ?>" readonly="true" >
							</div>
						</div>
						<label class="control-label col-xs-3" for="no_nota">
							No Nota
						</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="no_nota" id="no_nota" required="true" value="<?php echo $data['no_nota']; ?>" readonly="true" >
						</div>

					</div>
					<div class="form-group" >
						<label class="control-label col-xs-3" for="nama_customer">
							Jenis
						</label>
						<div class="col-xs-5">
							<input type="text" class="form-control" name="jenis" id="jenis" required="true" value="<?php echo $jenis; ?>" readonly="true" >
						</div>
					</div>
					<div class="form-group" >
						<label class="control-label col-xs-3" for="nama_customer">
							Nama Customer
						</label>
						<div class="col-xs-5">
							<input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" >
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" name="jumlah" id="jumlah" required="true" value="<?php echo $data['jumlah']; ?>" readonly="true" >
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
				</form>
				<form method="post" action="" id="form-input1" class="form-horizontal">
					
					<div class="form-group">
						<label  class="control-label col-xs-3 col-xs-3" for="jumlah1">
							Jumlah
						</label>
						<div class="col-xs-4">
							<input type="number" class="form-control" name="jumlah1" id="jumlah1" onblur="cek_jumlah();" autocomplete="off" required="true" >
						</div>
					</div>
					<div class="form-group">
						<label  class="control-label col-xs-3 col-xs-3" for="jumlah1">
							Harga
						</label>
						<div class="col-xs-4">
							<input type="number" class="form-control" name="harga" id="harga" autocomplete="off" required="true" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="ket">
							Keterangan
						</label>
						<div class="col-xs-5">
							<textarea type="text" class="form-control" name="ket1" id="ket1" required="true" >
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<input type="button" value="Simpan" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
					</div>
				</form>
				<div id="rincianspk" style="display: none">
					<script language="javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("content").innerHTML);
    newWindow.print(); 
}
</script>
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
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
			<?php

		}



	}
	else
	{
		$sql1 = mysqli_query($con,"SELECT * From reception where no_nota = '$no_nota' LIMIT 1");
		$data1= mysqli_fetch_assoc( $sql1 );
		echo "Tidak menemukan data bu <br>";
		echo 'packer :'.$data1['user_packing']."<br>";
		echo 'tgl packer :'.$data1['tgl_packing'];

	}
}