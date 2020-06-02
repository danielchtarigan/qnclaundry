                        <div class="panel-heading">
                            Kas Resepsionis dan Setoran Bank
                        </div>
                                        <div class="form-group">
                                        <form action='index.php' method='get'>
                                         <input type='hidden' name='menu' value='setoran_bank'>
                                                <label class="control-label col-xs-3" for="Kiloan">
                                                  Outlet
                                                </label>
                                                <div class="col-xs-4" >
                                                                <select class="form-control" name="outlet" id="outlet">
                                                                        <option value="">--</option>
                                                                        <?php
                                                                        $hotel = mysqli_query($con, "select * from outlet");
																		while($rh=mysqli_fetch_array($hotel)){
                                                                        ?>
                                                                        <option value="<?php echo $rh['nama_outlet']; ?>"><?php echo $rh['nama_outlet']; ?></option>
																		<?php
																			}
																		?>
                                                                </select>
                                                </div>
                                        <input type="submit" class="btn btn-success btpotongan" value="View" style="width:15%; background-color:#FFF; color:#6C0;" />
                                        </form>
                                        </div>                       
                                        <div class="form-group">
                                        <form action='index.php' method='get'>
                                        <input type='hidden' name='menu' value='setoran_bank'>
                                                <label class="control-label col-xs-3" for="Kiloan">
                                                  Recepsionis
                                                </label>
                                                <div class="col-xs-4" >
                                                                <select class="form-control" name="resepsionis" id="resepsionis">
                                                                        <option value="">--</option>
                                                                        <?php
                                                                        $hotel = mysqli_query($con, "select * from user where level='reception'");
																		while($rh=mysqli_fetch_array($hotel)){
                                                                        ?>
                                                                        <option value="<?php echo $rh['name']; ?>"><?php echo $rh['name']; ?></option>
																		<?php
																			}
																		?>
                                                                </select>
                                                </div>
                                        <input type="submit" class="btn btn-success btpotongan" value="View" style="width:15%; background-color:#FFF; color:#6C0;" />
                                        </form>
                                        </div>
                        <?php
                        if (isset($_GET['resepsionis'])){
                           include "include/laporan_setoran_bank_resepsionis.php";
                        }
                        else if (isset($_GET['outlet'])){
                           include "include/laporan_setoran_bank_outlet.php";
                        }
                        else{
                        ?>                                       
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:9px;">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pemasukan</th>
                                            <th>RCP Lunas</th>
                                            <th>Outlet</th>
                                            <th>Pendapatan CASH</th>
                                            <th>Nilai Tutup Kasir</th>
                                            <th>Jumlah Setoran</th>
                                            <th>Tanggal Setor</th>
                                            <th>BANK</th>
                                            <th>Kode Referensi</th>
                                            <th>Penyesuaian</th>
                                            <th>Keterangan Penyesuaian</th>
                                            <th>Selisih</th>
                                            <th>Status Verifikasi</th>
                                            <th>OP Verifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no = 31;
										$tahun = date('Y');
										$bulan = date('m');
										for($no; $no>1; $no--){
											$tanggal = $tahun.'-'.$bulan.'-'.sprintf('%02s', $no);
												$q1 = mysqli_query($con, "select * from outlet");
												while ($rq1 = mysqli_fetch_array($q1)){
													$cekrcp = mysqli_query($con, "select * from reception where tgl_input like '%$tanggal%' and nama_outlet='$rq1[nama_outlet]' group by rcp_lunas");
													$ncek = mysqli_num_rows($cekrcp);
													if ($ncek>0){
													while ($rcekrcp = mysqli_fetch_array($cekrcp)){
													$rcp = $rcekrcp['rcp_lunas'];
													$ot = $rq1['nama_outlet'];
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $tanggal; ?></td>
                                            <td><?php echo $rcp; ?></td>
                                            <td><?php echo $ot; ?></td>
                                            <?php
                                            $cash = mysqli_query($con, "select sum(jumlah) as cas from cara_bayar where resepsionis='$rcp' and outlet='$ot' and tanggal_input like '%$tanggal%' and (cara_bayar='Cash' or cara_bayar='cash')");
						$rcash = mysqli_fetch_array($cash);
						$tambahan = mysqli_query($con, "select sum(total) as tambah from faktur_penjualan where cara_bayar='cash' and jenis_transaksi<>'ritel' and tgl_transaksi like '%$tanggal%' and rcp='$rcp' and nama_outlet='$ot'");
						$rtambahan = mysqli_fetch_array($tambahan);
						$ntambahan = mysqli_num_rows($tambahan);
						if ($ntambahan>0){
						   $tmbh = $rtambahan['tambah'];
						}
						else{
						   $tmbh = 0;
						}
						$pengeluaran = mysqli_query($con, "select sum(pengeluaran) as keluar from tutup_kasir where tanggal like '%$tanggal%' and reception='$rcp' and outlet='$ot'");
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
                                            
                                            <td><?php echo rupiah($penerimaan); ?></td>
                                            <?php
                                             $kasir = mysqli_query($con, "select * from tutup_kasir where tanggal like '%$tanggal%' and reception='$rcp' and outlet='$ot'");
                                             $rkasir = mysqli_fetch_array($kasir);
                                            ?>                                            
                                                                                        
                                            <td><?php echo rupiah($rkasir['setoran_bersih']); ?></td>
                                            <?php
                                             $setor = mysqli_query($con, "select * from setoran_bank where reception = '$rcp' and outlet='$ot' and penerimaan1='$tanggal'");
                                             $rsetor = mysqli_fetch_array($setor);
                                            ?>                                            
                                            <td><?php echo rupiah($rsetor['setoran']); ?></td>
                                            <td><?php echo substr($rsetor['tanggal'],0,10); ?></td>
                                            <td><?php echo $rsetor['bank']; ?></td>
                                            <td><?php echo $rsetor['kode_referensi']; ?></td>
                                            <?php
                                            $ids = $rsetor['id'];
                                            $penyesuaian = mysqli_query($con, "select * from penyesuaian where id_setoran = '$ids'");
                                             $rpenyesuaian = mysqli_fetch_array($penyesuaian);
                                             $sesuai = $rpenyesuaian['penyesuaian'];
                                            ?>                                            
                                            <td>
                                            <?php 
                                            if ($rsetor['setoran']==0){
                                            }
                                            else{
                                            if ($sesuai==0){
                                            ?>
                                            <a href="index.php?menu=penyesuaian&ids=<?php echo $ids; ?>" onClick="return confirm('Apakah anda telah mengecek mutasi bank?')" ><button type="button" class="btn btn-primary btn-xs" style="background-color:#666666; border-color:#666666;" id="test" name="test">Proses</button></a>
                                            <?php
                                            }
                                            else{
                                            	echo rupiah($sesuai);
                                            }
                                            }
                                            ?></td>
                                            <td><?php echo $rpenyesuaian['keterangan'].' - '.$rpenyesuaian['op_penyesuaian']; ?></td>
                                            <td><?php echo rupiah($rsetor['setoran']-$penerimaan+$sesuai); ?></td>
                               	            <td align="center" style="vertical-align:middle;">
                                            <?php 

                                            if ($rsetor['setoran']==0){
                                            }
                                            else{
											if ($rsetor['verifikasi']=='Belum'){
											?>
                                            <a href="act/act_verifikasi.php?id=<?php echo $ids; ?>" onClick="return confirm('Apakah anda telah mengecek mutasi bank?')" ><button type="button" class="btn btn-primary btn-xs" style="background-color:#F00; border-color:#F00;" id="test" name="test">Proses</button></a>
											<?php
											} 
											else{
											?>
                                            <button type="button" class="btn btn-info btn-circle;"><i class="fa fa-check"></i></button>
                                            <?php
                                            }
                                            }
											?>
<script type="text/javascript">
	function very()
	{
	jawab = confirm("Apakah anda telah mengecek mutasi bank?");
        if (jawab == true) {
            return true;
        } else {
            return false;
        }
	};	
</script>
											</td>
                                            <td><?php echo $rsetor['op_verifikasi']; ?></td>
                                        </tr>
									<?php
									}
													}
											}
										}
									?>
                                    </tbody>
                                </table>
                                </div>
                                </div>                               
                                
                                <?php
                                }
                                ?>