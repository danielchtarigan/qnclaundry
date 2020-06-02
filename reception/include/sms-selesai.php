<div class="form-group">
                                                        <label class="control-label col-xs-12">
                                                               <strong>DATA OREDERAN SELESAI</strong>
                                                        </label>
                                                        <label class="control-label col-xs-4">
                                                               No Telepon Customer
                                                        </label>
                                                        <div class="control-label col-xs-6">
                                                                <textarea name="kritik" id="kritik" class="form-control" rows="10"><?php
 $telpo = mysqli_query($con, "select * from detail_so where outlet='$ot' order by id desc limit 0,1");
 $rtelp = mysqli_fetch_array($telpo);
 $telpo1 = mysqli_query($con, "select * from detail_so where tgl_so='$rtelp[tgl_so]'");
 $rtelp1 = mysqli_fetch_array($telpo1);
 while ($rtelp1 = mysqli_fetch_array($telpo1)){
	 $telpo2 = mysqli_query($con, "select * from reception a, customer b where a.id_customer=b.id and a.ambil='0' and a.no_nota='$rtelp1[no_nota]' group by b.no_telp order by a.id desc");
	 $rtelp2 = mysqli_fetch_array($telpo2);
	 echo $rtelp2['no_telp'].';';
	 }
	 $kembali = mysqli_query($con, "select * from reception a, customer b where a.id_customer=b.id and a.ambil='0' and a.tgl_kembali='$rtelp[tgl_so]' group by b.no_telp order by a.id desc");
	 while ($kembali2 = mysqli_fetch_array($kembali)){
	 echo $kembali2['no_telp'].';';
	 }
?>
</textarea>
<br>
                                                        </div>
                                                        <label class="control-label col-xs-4">
                                                               Isi Pesan / SMS
                                                        </label>
                                                        <div class="control-label col-xs-6">
                                                                <textarea name="kritik" id="kritik" class="form-control" rows="10"><?php
 $sms = mysqli_query($con, "select * from sms_kembali");
 $rsms = mysqli_fetch_array($sms);
 echo $rsms['sms'];
 ?>
</textarea>
                                                         <br />
                                                         *copy nomor telepon dan SMS diatas kemudian masukkan pada form SMS Customer (Gunakan modem SMS Gateway)
                                                        </div>                                                        
                                                </div>                                                                                   