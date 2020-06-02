                                    <?php                      
                                    $reception = $_SESSION['user_id'];
					$rcp = $reception;
						$no = 31;
						$tahun = date('Y');
						$bulan = date('m');
						$bersih = 0;
						$tambah = 0;
						$keluar = 0;
						$setoran = 0;
						$sesuai = 0;
						for ($no; $no>=1; $no--){
							$tanggal = $tahun.'-'.$bulan.'-'.sprintf('%02s', $no);
							$bersih2 = 0;
							$tambah2 = 0;
							$keluar2 = 0;
							$setoran2 = 0;
							$sesuai2 = 0;
							   $q2 = mysqli_query($con, "select sum(jumlah) as total from cara_bayar where resepsionis='$rcp' and tanggal_input like '%$tanggal%' and (cara_bayar='Cash' or cara_bayar='cash')");
							   $rq2 = mysqli_fetch_array($q2);
							   $bersih2=$bersih2+$rq2['total']; 
								$tambahan = mysqli_query($con, "select sum(total) as tambah from faktur_penjualan where cara_bayar like '%cash%' and jenis_transaksi<>'ritel' and tgl_transaksi like '%$tanggal%' and rcp='$rcp'");
								$rtambahan = mysqli_fetch_array($tambahan);
								$ntambahan = mysqli_num_rows($tambahan);
								if ($ntambahan>0){
								       $tmbh = $rtambahan['tambah'];
								}
								else{
									$tmbh = 0;
								}
								$tambah2 = $tambah2+$tmbh;
								$pengeluaran = mysqli_query($con, "select sum(pengeluaran) as keluar from tutup_kasir where tanggal like '%$tanggal%' and reception='$rcp'");
								$rpengeluaran = mysqli_fetch_array($pengeluaran);
								$npengeluaran = mysqli_num_rows($pengeluaran);
								if ($npengeluaran>0){
								   $klr = $rpengeluaran['keluar'];
								}
								else{
								   $klr = 0;
								}
								$keluar2 = $keluar2+$klr;
								$setor = mysqli_query($con, "select * from setoran_bank where reception = '$rcp' and penerimaan1='$tanggal' and verifikasi='Terverifikasi'");
                                            			$rsetor = mysqli_fetch_array($setor);
	                                            		$nsetor = mysqli_num_rows($setor);
								if ($nsetor>0){
								   $setr = $rsetor['setoran'];
								}
								else{
								   $setr = 0;
								}
								$setoran2 = $setoran2+$setr;
								$ids = $rsetor['id'];
                                             			$penyesuaian = mysqli_query($con, "select * from penyesuaian where id_setoran = '$ids'");
			                                        $rpenyesuaian = mysqli_fetch_array($penyesuaian);
                                             			$sesuai2 = $sesuai2+$rpenyesuaian['penyesuaian'];														    
  							$bersih = $bersih+$bersih2;
							$tambah = $tambah+$tambah2;
							$keluar = $keluar+$keluar2;
							$setoran = $setoran+$setoran2;
							$sesuai = $sesuai+$sesuai2;
}

							$penerimaan = ($bersih+$tambah-$keluar-$setoran+$sesuai);
?>
                        <!--<div class="panel-heading">
                            <strong>Selamat datang, <?php echo $_SESSION['user_id']; ?>. Total Kas Anda : <?php echo rupiah($penerimaan); ?>. Berikut daftar setoran bank anda</strong>
                        </div>-->
                        <div class="panel-heading">
                            <strong>Selamat datang, <?php echo $_SESSION['user_id']; ?>. Berikut daftar setoran bank anda</strong>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px;">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pemasukan</th>
                                            <th>RCP Lunas</th>
                                            <th>Outlet</th>
                                            <th>Pendapatan CASH</th>
                                            <th>Jumlah Setoran</th>
                                            <th>BANK</th>
                                            <th>Kode Referensi</th>
                                            <th>Selisih</th>											
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no = 31;
										for($no; $no>=1; $no--){
											$tanggal = $tahun.'-'.$bulan.'-'.sprintf('%02s', $no);
													$cekrcp = mysqli_query($con, "select * from reception where tgl_input like '%$tanggal%' and rcp_lunas='$_SESSION[user_id]' and cara_bayar='cash' group by rcp_lunas,nama_outlet");
													$ncek = mysqli_num_rows($cekrcp);
													if ($ncek>0){
													while ($rcekrcp = mysqli_fetch_array($cekrcp)){
													$rcp = $rcekrcp['rcp_lunas'];
$ot = $rcekrcp['nama_outlet'];
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $tanggal; ?></td>
                                            <td><?php echo $rcp; ?></td>
                                            <td><?php echo $ot; ?></td>
                                            <?php
                                            $cash = mysqli_query($con, "select sum(total_bayar) as cas from reception where rcp_lunas='$rcp' and nama_outlet='$ot' and tgl_lunas like '%$tanggal%' and cara_bayar='cash'");
						$rcash = mysqli_fetch_array($cash);
						$tambahan = mysqli_query($con, "select sum(total) as tambah from faktur_penjualan where cara_bayar='cash' and jenis_transaksi<>'ritel' and tgl_transaksi like '%$tanggal%' and rcp='$rcp'");
						$rtambahan = mysqli_fetch_array($tambahan);
						$ntambahan = mysqli_num_rows($tambahan);
						if ($ntambahan>0){
						   $tmbh = $rtambahan['tambah'];
						}
						else{
						   $tmbh = 0;
						}
						$pengeluaran = mysqli_query($con, "select sum(pengeluaran) as keluar from tutup_kasir where tanggal like '%$tanggal%' and reception='$rcp'");
											$rpengeluaran = mysqli_fetch_array($pengeluaran);
											$npengeluaran = mysqli_num_rows($pengeluaran);
											if ($npengeluaran>0){
											   $klr = $rpengeluaran['keluar'];
											}
											else{
											   $klr = 0;
											}
						$penerimaan = $rcash['cas']+$tmbh-$klr;
						?>
                                            
                                            <td style="text-align:center">----</td>
                                            <?php
                                             $setor = mysqli_query($con, "select * from setoran_bank where reception = '$rcp' and penerimaan1='$tanggal'");
                                             $rsetor = mysqli_fetch_array($setor);
											 
                                            ?>                                            
                                            <td><?php echo rupiah($rsetor['setoran']); ?></td>
                                            <td><?php echo $rsetor['bank']; ?></td>
                                            <td><?php echo $rsetor['kode_referensi']; ?></td>
                                            <?php
                                            $ids = $rsetor['id'];
                                            $penyesuaian = mysqli_query($con, "select * from penyesuaian where id_setoran = '$ids'");
                                             $rpenyesuaian = mysqli_fetch_array($penyesuaian);
                                             $sesuai = $rpenyesuaian['penyesuaian'];
                                            ?>
                                            <td><?php if(mysqli_num_rows($setor)>0 && (rupiah($rsetor['setoran']-$penerimaan+$sesuai)<'Rp.0')) echo 'Kurang Setor' ; elseif(rupiah($rsetor['setoran']-$penerimaan+$sesuai)<'Rp.0') echo 'Belum Setor' ; else echo 'Bersih';?></td>
                               	            
                                        </tr>
									<?php
									}
													}
											
										}
									?>
                                    </tbody>
                                </table>
                                </div>
                                </div>                                                              
