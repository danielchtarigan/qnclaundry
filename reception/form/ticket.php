<?php


$query = "SELECT * FROM ticket order by kode desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['kode'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 4, 4);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;
$noso = "QNCT".sprintf('%04s', $nextNoUrut1);
?>
<form action="act/add-ticket.php" method="GET" name="form3" id="form3">
                                        <div class="form-group">
                                            <label>Kode Ticket</label>
                                            <input class="form-control" name="kode" placeholder="Kode Ticket" value="<?php echo $noso; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input class="form-control" name="title" placeholder="Title" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="keterangan" placeholder="Keterangan" required="required"></textarea>
                                        </div>
                                        <div class="form-group">
<input type="submit" class="btn btn-success btpotongan" value="Simpan" style="width:100%; background-color:#6C0;"/>                                        </div>
</form>