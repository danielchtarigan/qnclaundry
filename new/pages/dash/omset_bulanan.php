<?php 

$month = date('Y-m', strtotime($nowDate));

function omset_bulanan($month,$outlet) {
    global $con;
    $sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE (DATE_FORMAT(tgl_input, '%Y-%m') LIKE '$month') AND nama_outlet='$outlet' AND lunas=true AND (cara_bayar<>'Reject' OR cara_bayar<>'Void') ");
    $data = mysqli_fetch_row($sql);
    return $data[0];
}

function order_bulanan($month,$outlet) {
    global $con;
    $sql = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) AS jumlah FROM reception WHERE (DATE_FORMAT(tgl_input, '%Y-%m') LIKE '$month') AND nama_outlet='$outlet' AND lunas=true AND (cara_bayar<>'Reject' OR cara_bayar<>'Void') ");
    $data = mysqli_fetch_row($sql);
    return $data[0];
}

function progress_opr($month,$outlet) {
    global $con;
    $sql = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) AS jumlah FROM reception WHERE nama_outlet='$outlet' AND lunas=true AND cara_bayar<>'Reject' AND cara_bayar<>'Void'  AND (kembali=false or packing=false OR tgl_so='0000-00-00 00:00:00')");
    $data = mysqli_fetch_row($sql);
    return $data[0];
}

?>

<div class="col-md-4">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <div class="row">           
                <div class="col-xs-9 text-right">
                    <div class="huge"><font size="6px"><?php echo 'Rp '.rupiah(omset_bulanan($month,$outlet));?></font></div>
                    <p style="font-weight: bolder">Omset Bulan <?php echo date('M Y', strtotime($nowDate)) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <div class="row">           
                <div class="col-xs-9 text-right">
                    <div class="huge"><font size="6px"><?php echo order_bulanan($month,$outlet).' Order';?></font></div>
                    <p style="font-weight: bolder">Order Bulan <?php echo date('M Y', strtotime($nowDate)) ?></p>
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="col-md-4">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <div class="row">           
                <div class="col-xs-9 text-right">
                    <div class="huge"><font size="6px"><?php echo rupiah(progress_opr($month,$outlet)).' Order';?></font></div>
                    <p style="font-weight: bolder">Cucian Belum Selesai</p>
                </div>
            </div>
        </div>        
    </div>
</div>


    