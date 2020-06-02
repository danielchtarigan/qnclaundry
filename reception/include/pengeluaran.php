<form action="act/act_pengeluaran.php" method="get" name="pengeluaran" id="pengeluaran" target="_blank">
<strong>FORM PENGELUARAN</strong>
<br /><br />
<?php
$query   = "SELECT max(id) AS last FROM pengeluaran LIMIT 0,1";
$hasil   = mysqli_query($con,$query);
$k       = mysqli_fetch_array($hasil);
$no_urut = $k['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//fCDW000001
$terakhir= (int)substr($no_urut, 4, 6);
// nomor urut ditambah 1
$nextNoUrut = $terakhir + 1;
$char = "QOUT";
// membuat format nomor transaksi berikutnya
$nofaktur = $char.sprintf('%06s', $nextNoUrut);
?>

<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Nota
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="id" name="id" class="form-control" readonly="readonly" width="100%" value="<?php echo $nofaktur; ?>">
                                                </div><br /><br>
</div>

<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Keperluan
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="item" name="item" class="form-control" placeholder="Item Keperluan" width="100%">
                                                </div><br /><br>
</div>
<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Jumlah Uang
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="uang" name="uang" class="form-control" placeholder="0" width="100%">
                                                </div><br /><br>
</div>
<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Penerima
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="penerima" name="penerima" class="form-control" placeholder="0" width="100%">
                                                </div><br /><br>
</div>
<div class="form-group just_kiloan">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Keterangan
                                                </label>
                                                <div class="col-xs-9" >
                                                        <textarea id="keterangan" name="keterangan" class="form-control" width="100%"></textarea>
                                                </div><br /><br>
</div>
<div class="form-group just_kiloan">
<input type="submit" value="submit" name="submit" name="id" />
</div>
</form>
                                        