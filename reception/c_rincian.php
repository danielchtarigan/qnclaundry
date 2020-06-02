<?php
include '../config.php';
session_start();
$cari = $_GET['cari'];
if( !empty ( $cari ) )
{
	$sql = mysqli_query($con,"SELECT a.tgl_input,a.jenis,a.nama_reception,a.no_nota,a.nama_customer,a.id_customer,b.no_telp,a.total_bayar,a.jumlah,a.berat,a.rcp_spk,a.tgl_spk,a.op_cuci,a.tgl_cuci,a.op_pengering,a.tgl_pengering,a.user_setrika,a.tgl_setrika,a.user_packing,a.tgl_packing from reception a join customer b on a.id_customer=b.id where no_nota = '$cari' LIMIT 1");

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
			?><br/>
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
				<tr>
					<td>
						<font size=2>Tgl masuk
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['nama_reception']; ?>
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['tgl_input']; ?>
						</font>
					</td>
					
				</tr>
				<tr>
					<td>
						<font size=2>
							No Nota
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['no_nota']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size=2>Nama
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['nama_customer']; ?>
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['no_telp']; ?>
						</font>
					</td>
				</tr>

				<tr>
					<td>
						<font size=2>
							Total
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['total_bayar']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size=2>
							Jumlah
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['jumlah']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size=2>
							Berat
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['berat']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size=2>
							Jenis
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['jenis']; ?>
						</font>
					</td>
				</tr>
				
				<tr>
					<td>
						<font size=2>
							spk
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['rcp_spk']; ?>
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['tgl_spk']; ?>
						</font>
					</td>

				</tr>
				<tr>
					<td>
						<font size=2>
							cuci
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['op_cuci']; ?>
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['tgl_cuci']; ?>
						</font>
					</td>

				</tr>
				<tr>
					<td>
						<font size=2>
							kering
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['op_pengering']; ?>
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['tgl_pengering']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size=2>
							setrika
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['user_setrika']; ?>
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['tgl_setrika']; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td>
						<font size=2>
							Packing
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['user_packing']; ?>
						</font>
					</td>
					<td>
						:
						<font size=2>
							<?php echo $data['tgl_packing']; ?>
						</font>
					</td>
				</tr>

			</table>
			<table border="1">
			rincian
				<?php

			$sql2 = mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$cari' and id_customer='$data[id_customer]'");

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

			$sql2 = mysqli_query($con,"SELECT * FROM detail_spk WHERE no_nota= '$cari'");

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
			<?php

		}



	}
	else
	{
		$sql1 = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' LIMIT 1");
		$data1= mysqli_fetch_assoc( $sql1 );
		echo "Tidak menemukan data bu <br>";
		echo 'packer :'.$data1['user_packing']."<br>";
		echo 'tgl packer :'.$data1['tgl_packing'];

	}
}