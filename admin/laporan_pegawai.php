<html>
<head>

<?php

date_default_timezone_set('Asia/Makassar');
include "header.php";
include "../config.php";
include '../laporan_pegawai_functions.php';
if (isset($_GET['tanggal_awal'])) $tanggal_awal = htmlspecialchars($_GET['tanggal_awal']);
if (isset($_GET['tanggal_akhir'])) $tanggal_akhir = htmlspecialchars($_GET['tanggal_akhir']);
?>
</head>
<body>


<div class="container" style="width:auto; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">
	<script type="text/javascript">
		$(document).ready(function(){
			$('#laporan').dataTable({
        "order": [[ 1,"asc" ]],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },

                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }

                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"4px",
                    },
                ],
                "bAutoWidth": false,


				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 100,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],

			}).yadcf([
	    {column_number : 1}
	    ]);

		});
	</script>

<fieldset>
<legend align="center" ><strong>Laporan Gaji Pegawai</strong></legend>
<?php

  /*if (isset($bulan)&&isset($tahun)) {
    $startMonth = $bulan;
    $startYear = $tahun;
    $startDate = mktime(0,0,0,$bulan,26,$tahun);
    $endDate = mktime(0,0,0,$bulan+1,25,$tahun);
  } else { */
		if (isset($tanggal_awal)&&isset($tanggal_akhir)) {
			$startDate = strtotime($tanggal_awal);
			$endDate = strtotime($tanggal_akhir);
		} else {
    $bulan = date("m");
    $tahun = date("Y");
    if (date("d")<26) {
      $startMonth = $bulan-1;
			$startYear = $tahun;
      $startDate = mktime(0,0,0,$bulan-1,26,$tahun);
      $endDate = mktime(0,0,0,$bulan,25,$tahun);
      if ($startMonth==0) {
        $startMonth = 12;
        $startYear = $tahun-1;
      }
    } else {
      $startMonth = $bulan;
      $startYear = $tahun;
      $startDate = mktime(0,0,0,$bulan,26,$tahun);
      $endDate = mktime(0,0,0,$bulan+1,25,$tahun);
    }
  }
?>

<h4><?php echo 'Tanggal '.date("d F Y",$startDate).' - '.date("d F Y",$endDate); ?></h4>
<div>
  <form action="laporan_pegawai.php">
  <?php /*<select name="bulan" id="bulan-picker" required>
    <option <?php if($startMonth=='1') echo 'selected';?> value="1">26 Januari - 25 Februari</option>
    <option <?php if($startMonth=='2') echo 'selected';?> value="2">26 Februari - 25 Maret</option>
    <option <?php if($startMonth=='3') echo 'selected';?> value="3">26 Maret - 25 April</option>
    <option <?php if($startMonth=='4') echo 'selected';?> value="4">26 April - 25 Mei</option>
    <option <?php if($startMonth=='5') echo 'selected';?> value="5">26 Mei - 25 Juni</option>
    <option <?php if($startMonth=='6') echo 'selected';?> value="6">26 Juni - 25 Juli</option>
    <option <?php if($startMonth=='7') echo 'selected';?> value="7">26 Juli - 25 Agustus</option>
    <option <?php if($startMonth=='8') echo 'selected';?> value="8">26 Agustus - 25 September</option>
    <option <?php if($startMonth=='9') echo 'selected';?> value="9">26 September - 25 Oktober</option>
    <option <?php if($startMonth=='10') echo 'selected';?> value="10">26 Oktober - 25 November</option>
    <option <?php if($startMonth=='11') echo 'selected';?> value="11">26 November - 25 Desember</option>
    <option <?php if($startMonth=='12') echo 'selected';?> value="12">26 Desember - 25 Januari (+1)</option>
  </select> */ ?>
  <input type="text" name="tanggal_awal" value="<?php echo date('d-m-Y',$startDate); ?>" required></input>
	 sampai
  <input type="text" name="tanggal_akhir" value="<?php echo date('d-m-Y',$endDate); ?>" required></input>
  <button class="btn btn-default" type="submit">Ganti Tanggal</button>
</form>
</div>
<table id="laporan" style="font-size:10px">
		<thead>
		<tr>
			<th>Username</th>
			<th>Jabatan</th>
			<th>Jumlah Hari</th>
      <th>QA</th>
      <th>Target Harian</th>
      <th>Cuci Kiloan</th>
      <th>Cuci Potongan</th>
      <th>Pengering</th>
			<th>Setrika</th>
			<th>Packing Kiloan</th>
			<th>Packing Potongan</th>
			<th>Cuci Hotel</th>
			<th>Packing Hotel</th>
			<th>Target Bulanan</th>
      <th>Total Poin</th>
      <th>Selisih Poin</th>
      <th>Gaji Standar</th>
      <th>Gaji Bruto</th>
      <th>Bonus</th>
      <th>Gaji Bersih</th>
		</tr>
		</thead>
		<tbody>
      <?php $users = daftar_user();
      while ($user=mysqli_fetch_assoc($users)) {
        $data=laporan_pegawai($user['name'],$user['level'],date("Y/m/d",$startDate),date("Y/m/d",$endDate));
        if ($data['jumlah_hari_kerja']>0) {
        ?>
        <tr>
          <td><?php echo $user['name']; ?></td>
          <td><?php echo $data['jabatan']; ?></td>
          <td><?php echo $data['jumlah_hari_kerja']; ?></td>
          <td><?php echo $data['qa']; ?></td>
          <td><?php echo $data['target_harian']; ?></td>
          <td><?php if (array_key_exists('cuci_kiloan',$data)) echo $data['cuci_kiloan']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('cuci_potongan',$data)) echo $data['cuci_potongan']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('pengering',$data)) echo $data['pengering']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('setrika',$data)) echo $data['setrika']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('packing_kiloan',$data)) echo $data['packing_kiloan']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('packing_potongan',$data)) echo $data['packing_potongan']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('cuci_corp',$data)) echo $data['cuci_corp']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('packing_corp',$data)) echo $data['packing_corp']; else echo '0'; ?></td>
          <td><?php echo $data['target_bulanan']; ?></td>
          <td><?php echo $data['total_poin']; ?></td>
          <td><?php echo $data['selisih_poin']; ?></td>
          <td><?php echo $data['gaji_standar']; ?></td>
          <td><?php echo $data['gaji_bruto']; ?></td>
          <td><?php echo $data['gaji_bonus']; ?></td>
          <td><?php echo $data['gaji_bersih']; ?></td>
        </tr>
      <?php }
      } ?>
      <?php $users = daftar_user_corp();
      while ($user=mysqli_fetch_assoc($users)) {
        $data=laporan_corp($user['id'],date("Y/m/d",$startDate),date("Y/m/d",$endDate));
        if ($data['jumlah_hari_kerja']>0) {
        ?>
        <tr>
          <td><?php echo $user['name']; ?></td>
          <td><?php echo $data['jabatan']; ?></td>
          <td><?php echo $data['jumlah_hari_kerja']; ?></td>
          <td><?php echo $data['qa']; ?></td>
          <td><?php echo $data['target_harian']; ?></td>
          <td><?php if (array_key_exists('cuci_kiloan',$data)) echo $data['cuci_kiloan']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('cuci_potongan',$data)) echo $data['cuci_potongan']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('pengering',$data)) echo $data['pengering']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('setrika',$data)) echo $data['setrika']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('packing_kiloan',$data)) echo $data['packing_kiloan']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('packing_potongan',$data)) echo $data['packing_potongan']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('cuci_corp',$data)) echo $data['cuci_corp']; else echo '0'; ?></td>
          <td><?php if (array_key_exists('packing_corp',$data)) echo $data['packing_corp']; else echo '0'; ?></td>
          <td><?php echo $data['target_bulanan']; ?></td>
          <td><?php echo $data['total_poin']; ?></td>
          <td><?php echo $data['selisih_poin']; ?></td>
          <td><?php echo $data['gaji_standar']; ?></td>
          <td><?php echo $data['gaji_bruto']; ?></td>
          <td><?php echo $data['gaji_bonus']; ?></td>
          <td><?php echo $data['gaji_bersih']; ?></td>
        </tr>
      <?php }
      } ?>
		</tbody>
	</table>
	</fieldset>
</div>
</body>
</html>
