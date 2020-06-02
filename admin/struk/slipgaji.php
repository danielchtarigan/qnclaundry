<body onLoad="print()">
<?php
include '../../config.php';

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d h:i:s");	 

?>
<style type="text/css">
  <!--
  .style1 {font-weight: bold}
  .style3 {font-size: 16px}
  -->
</style>

<!-- 
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
-->
	<div class="content" id="content">
		<div style="max-width:148mm;margin:5mm;"><div align="center"><img src="../../logo.bmp" /></div>   
			<div style="font-size: 9pt; font-family: Tahoma"><div align="center"></div>
	  
			<?php
			  $user = $_GET['user'];
			  $awal = $_GET['awal'];
			  $akhir = $_GET['akhir'];

			  $qkpircp = mysqli_query($con, "SELECT *FROM kpi_resepsionis WHERE rcp='$user' AND tgl_awal='$awal' AND tgl_akhir='$akhir' ");
			  $datakpi = mysqli_fetch_array($qkpircp);

			  $gajipokok = $datakpi['gaji_pokok'];
			 

			  if($datakpi['tipe_rcp']=='A' || $datakpi['tipe_rcp']=='A+'){
				$lemburreg = $datakpi['lembur_reg'];
				$qtlemburreg = $lemburreg/(($gajipokok/25/8)*2);
				$duabelas = $datakpi['lembur_duabelas'];
				$qtduabelas = $duabelas/(($gajipokok/25/8)*4);
				$bonusspk = $datakpi['bonus_spk'];
				$qtbonusspk = $bonusspk/0.04;
				$reject = $datakpi['kasus_reject'];
				$qtreject = $reject/0.08;
				$bonusqa = $datakpi['bonus_qa'];
				$qtbonusqa = $bonusqa/5000;
				$bonusmember = $datakpi['bonus_member'];
				$qtbonusmember = $bonusmember/20000;
				$bonusomset = $datakpi['komisi_omset'];
				$qtbonusomset = 0;
				$komisilgn = $datakpi['komisi_lgn'];
				$qtkomisilgn = $komisilgn/0.1;
				$tsetor = $datakpi['tidak_menyetor'];
				$qttsetor = 0;
				$ttutupkasir = $datakpi['tidak_tk'];
				$qtttutupkasir = -$ttutupkasir/25000;
				$tso = $datakpi['tidak_so'];
				$qttso = -$tso/5000;
				$izinplus = $datakpi['izin_lebih_dua_jam'];
				$qtizinplus = $izinplus/(($gajipokok/25)*-1);
				$izinmin = $datakpi['izin_kurang_dua_jam'];
				$qtizinmin = $izinmin/(($gajipokok/25)*-2);
				$absen = $datakpi['absen'];
				$qtabsen = $absen/(($gajipokok/25)*-3);
				$aktelat = 0;
			  }
			  else if($datakpi['tipe_rcp']=='C'){
				$lemburreg = $datakpi['lembur_reg'];
				$qtlemburreg = $lemburreg/(($gajipokok/25/12)*2);
				$duabelas = 0;
				$qtduabelas = 0;
				$bonusspk = 0;
				$qtbonusspk = 0;
				$reject = 0;
				$qtreject = 0;
				$bonusqa = 0;
				$qtbonusqa = 0;
				$bonusmember = $datakpi['bonus_member'];
				$qtbonusmember = $bonusmember/20000;
				$bonusomset = $datakpi['komisi_omset'];
				$qtbonusomset = 0;
				$komisilgn = $datakpi['komisi_lgn'];
				$qtkomisilgn = $komisilgn/0.1;
				$tsetor = $datakpi['tidak_menyetor'];
				$qttsetor = 0;
				$ttutupkasir = $datakpi['tidak_tk'];
				$qtttutupkasir = -$ttutupkasir/25000;
				$tso = $datakpi['tidak_so'];
				$qttso = -$tso/5000;
				$izinplus = $datakpi['izin_lebih_dua_jam'];
				$qtizinplus = $izinplus/(($gajipokok/25)*-1);
				$izinmin = $datakpi['izin_kurang_dua_jam'];
				$qtizinmin = $izinmin/(($gajipokok/25)*-2);
				$absen = $datakpi['absen'];
				$qtabsen = $absen/(($gajipokok/25)*-3);
				$aktelat = 0;
			  }
			  else if($datakpi['tipe_rcp']=='Peluncur'){
				$lemburreg = $datakpi['lembur_reg'];
				$qtlemburreg = $lemburreg/(($gajipokok/25/12)*2);
				$duabelas = $datakpi['lembur_duabelas'];
				$qtduabelas = $duabelas/(($gajipokok/25/8)*4);
				$bonusspk = 0;
				$qtbonusspk = 0;
				$reject = 0;
				$qtreject = 0;
				$bonusqa = 0;
				$qtbonusqa = 0;
				$bonusmember = $datakpi['bonus_member'];
				$qtbonusmember = $bonusmember/20000;
				$bonusomset = $datakpi['komisi_omset'];
				$qtbonusomset = 0;
				$komisilgn = $datakpi['komisi_lgn'];
				$qtkomisilgn = $komisilgn/0.1;
				$tsetor = $datakpi['tidak_menyetor'];
				$qttsetor = 0;
				$ttutupkasir = $datakpi['tidak_tk'];
				$qtttutupkasir = -$ttutupkasir/25000;
				$tso = $datakpi['tidak_so'];
				$qttso = -$tso/5000;
				$izinplus = $datakpi['izin_lebih_dua_jam'];
				$qtizinplus = $izinplus/(($gajipokok/25)*-1);
				$izinmin = $datakpi['izin_kurang_dua_jam'];
				$qtizinmin = $izinmin/(($gajipokok/25)*-2);
				$absen = $datakpi['absen'];
				$qtabsen = $absen/(($gajipokok/25)*-3);
				$aktelat = 0;
			  }
			  else if($datakpi['tipe_rcp']=='Part Time'){
				$lemburreg = $datakpi['lembur_reg'];
				$qtlemburreg = $lemburreg/(($gajipokok/25/4)*2);
				$duabelas = $datakpi['lembur_duabelas'];
				$qtduabelas = $duabelas/(($gajipokok/25/4)*8);
				$bonusspk = 0;
				$qtbonusspk = 0;
				$reject = 0;
				$qtreject = 0;
				$bonusqa = 0;
				$qtbonusqa = 0;
				$bonusmember = 0;
				$qtbonusmember = 0;
				$bonusomset = $datakpi['komisi_omset'];
				$qtbonusomset = 0;
				$komisilgn = 0;
				$qtkomisilgn = 0;
				$tsetor = 0;
				$qttsetor = 0;
				$ttutupkasir = 0;
				$qtttutupkasir = 0;
				$tso = 0;
				$qttso = 0;
				$izinplus = 0;
				$qtizinplus = 0;
				$izinmin = 0;
				$qtizinmin = 0;
				$absen = 0;
				$qtabsen = 0;
				$aktelat = 0;
			  }			
					
			?>
			<br>       
			<div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-size:11pt;">Key Performance Indicator</span></strong></div>
			<div align="center" class="style1 style4"><span class="style3" style="font-family: arial; font-size:9pt;">(Resepsionis Outlet)</span></div>
			<br>
				<table style="border-top: 1px solid #000;border-bottom: 1px solid #000; width:100%; font-size: 12px">
				  <tr>
					<td>Nama Karyawan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
					<td>:</td>
					<td><?php echo $user; ?></td>
				  </tr>
				  <tr>
					<td>Periode Gaji</td>
					<td>:</td>
					<td><?php echo $datakpi['tgl_awal'].' sd '.$datakpi['tgl_akhir']; ?></td>
				  </tr>
				  <tr>
					<td>Status Karyawan</td>
					<td>:</td>
					<td><?php echo 'Tipe '.$datakpi['tipe_rcp'] ?></td>
				  </tr>
				</table>

				<table style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; width:100%; font-size: 10px;"><br>
				  <tr>
					<th>KETERANGAN</th>
					<th>NILAI</th> 
					<th>HITUNG</th>
				  </tr>
				</table>
				<table style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; width:100%; font-size: 10px;margin-top: 1px;">
				  <tr>
					<td>Gaji Pokok</td>
					<td align="right"><?php echo $datakpi['hari_kerja'] ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($datakpi['gaji_pokok'],0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Tambahan Tugas Admin &nbsp; &nbsp; &nbsp;</td>
					<td align="right"><?php echo '-' ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php '-' ?></td>
				  </tr>
				  <tr>
					<td>Lembur Reguler</td>
					<td align="right"><?php echo number_format($qtlemburreg,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($lemburreg,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Lembur 12 Jam</td>
					<td align="right"><?php echo number_format($qtduabelas,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($duabelas,0,',','.'); ?></td>
				  </tr>
				</table>

				<table style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; width:100%; font-size: 10px;margin-top: 5px;">
				  <tr>
					<td>Bonus 4% SPK</td>
					<td align="right"><?php echo number_format($qtbonusspk,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($bonusspk,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Potongan Reject -8%</td>
					<td align="right"><?php echo number_format($qtreject,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($reject,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Bonus QA Rp. 5.000,-<br>(Max 20 Customer)</td>    
					<td align="right"><?php echo  number_format($qtbonusqa,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($bonusqa,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Bonus Rp. 20.000,-/Member</td>    
					<td align="right"><?php echo number_format($qtbonusmember,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($bonusmember,0,',','.'); ?></td>
				  </tr>
				   <tr>
					<td>Bonus Rp. 200,000.-/Tiap<br>Kenaikan Omset Rp. 2 Juta</td>    
					<td align="right"><?php echo number_format($bonusomset,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($bonusomset,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Komisi 10% Laundry<br>Berlangganan Baru</td>    
					<td align="right"><?php echo number_format($qtkomisilgn,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($komisilgn,0,',','.'); ?></td>
				  </tr>
				</table>

				<table style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; width:100%; font-size: 10px;margin-top: 5px;">
				  <tr>
					<td>Denda Rp. 5,000.-/Tidak<br>setor pd Senin, Rabu, Jumat</td>
					<td align="right"><?php echo number_format($qttsetor,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($tsetor,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Denda Rp. 25,000.-/Shift<br>Tidak tutup kasir</td>
					<td align="right"><?php echo number_format($qtttutupkasir,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($ttutupkasir,0,',','.'); ?></td>
				  </tr>  
				  <tr>
					<td>Denda Rp. 5,000.-/Shift<br>Tidak opname harian</td>
					<td align="right"><?php echo number_format($qttso,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($tso,0,',','.'); ?></td>
				  </tr>
				</table>

				<table style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; width:100%; font-size: 10px;margin-top: 5px;">
				  <tr>
					<td>Absen dengan izin<br>di atas 2 jam sebelum kerja &nbsp;</td>
					<td align="right"><?php echo number_format($qtizinplus,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($izinplus,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Absen dengan izin<br>kurang 2 jam sebelum kerja</td>
					<td align="right"><?php echo number_format($qtizinmin,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($izinmin,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Tidak masuk tanpa<br>pemberitahuan sama sekali</td>
					<td align="right"><?php echo number_format($qtabsen,0,',','.'); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($absen,0,',','.'); ?></td>
				  </tr>
				  <tr>
					<td>Akumulasi terlambat masuk</td>
					<td align="right"><?php echo 0 ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($aktelat,0,',','.'); ?></td>
				  </tr>   
				</table>
				<table style="border-top: 1px double #000; border-bottom: 1px double #000; border-left: 1px double #000; border-right: 1px double #000; width:100%; font-size: 10px;margin-top: 5px;">
				</table>
				<table style="border-top: 1px double #000; border-bottom: 1px double #000; border-left: 1px double #000; border-right: 1px double #000; width:100%; margin-top: 1px; font-weight: bold; font-size: 12px">
				  <tr>
					<td align="center">Gaji Bersih &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;</td>
					<td></td>
					<td>Rp.</td>
					<td align="right"><?php echo number_format($datakpi['gaji_bersih'],0,',','.'); ?></td>
				  </tr>
				</table>
				<table style="border-top: 1px double #000; border-bottom: 1px double #000; border-left: 1px double #000; border-right: 1px double #000; width:100%; font-size: 10px;margin-top: 1px;">
				</table>
				
			</div>
		</div>
	</div>




</body>