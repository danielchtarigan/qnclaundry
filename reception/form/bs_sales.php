<?php

include "popup.php";
date_default_timezone_set('Asia/Makassar');

function customer($id) {
    global $con;
    $customers = $con->query("Select * From Customer Where id=$id");   
    return $customers;
}

function kuota_lgn($id) {
    global $con;
    $kuotas = $con->query("Select * From langganan Where id_customer=$id");
    $kuota = $kuotas->fetch_array();
    return $kuota;
}

?>

<style>
    h4 {
        font-size: 16px;
        font-weight: bold
    }
    .panel-1 {
        min-height: 190px;
    }

    .panel-bottom {
        position: absolute;
        left: 30px;
        right: 30px;
        bottom: 35px
    }
</style>

<!-- <div class="panel-heading">
    <p align="center" style="color:#690;"><strong> TRANSAKSI PENJUALAN </strong></p>
</div> -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default panel-1">
            <div class="panel-body">
                <h4>Informasi Pelanggan</h4>
                <?php
                    $customer = mysqli_fetch_array(customer($_GET['ids']));
                    echo $customer['nama_customer'].' | '.$customer['no_telp'].'<br>'.$customer['alamat'] 
                ?>
                <div class="panel-bottom">
                    <a href="#popupeditdatacs" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="background-color:#6C0;">Edit Data</a>
                </div>
                
                    
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default panel-1">
            <div class="panel-body">
                <h4>Berlangganan Kuota</h4>
                <?php 
                    if ($customer['lgn'] == 0) {
                        echo "Belum berlangganan";
                        echo "<br><br>";
                        echo '
                            <div class="panel-bottom">
                                <a href="#popup14" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="margin-bottom: 5px; background-color:#6C0;">
                                    Daftar Langganan
                                </a>
                            </div>
                        ';
                    }
                    else {
                        echo '
                        <table width="100%" style="font-size: 14px">
                            <tr><td>Cuci Kering Setrika</td><td>: &nbsp;</td><td>'.kuota_lgn($_GET['ids'])['kilo_cks'].' Kg</td></tr>
                            <tr><td>Potongan</td><td>: &nbsp;</td><td>'.kuota_lgn($_GET['ids'])['potongan'].'</td></tr>
                            <tr><td>Aktif s.d</td><td>: &nbsp;</td><td>'.date_format(date_create(kuota_lgn($_GET['ids'])['tgl_expire']), 'd/m/Y').'</td></tr>
                        </table>
                        ';
                        echo '<br><br>';
                        echo '
                            <div class="panel-bottom">
                                <a href="#popup13" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="background-color:#6C0;">
                                    Tambah Deposit
                                </a>
                            </div>
                        ';
                    }

                ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default panel-1">
            <div class="panel-body">
                <h4>Menu Utama Penjualan</h4>
                <div class="panel-bottom">
                    <a href="index.php?id=<?php echo $_GET['id']; ?>&menu=ambil">
                        <input type="button" class="btn btn-success btkiloan" value="Pesanan" style="width:49%; background-color:#6C0;"/>
                    </a>
                    <a href="index.php?id=<?php echo $_GET['id']; ?>&menu=ambil">
                        <input type="button" class="btn btn-success btkiloan" value="Pengambilan" style="width:49%; background-color:#6C0;"/>
                    </a>
                    <a href="index.php?id=<?php echo $_GET['id']; ?>&menu=ambil">
                        <input type="button" class="btn btn-success btkiloan" value="Komplain" style="width:49%; margin-top: 5px; background-color:#6C0;"/>
                    </a>
                    <a href="index.php?id=<?php echo $_GET['id']; ?>&menu=ambil">
                        <input type="button" class="btn btn-success btkiloan" value="Quality Audit" style="width:49%; margin-top: 5px;; background-color:#6C0;"/>
                    </a>
                </div>
            </div>
        </div>
    </div>    

    <div class="col-lg-6">
        <div class="panel panel-default panel-1">
            <div class="panel-body">
                <h4>Membership</h4>
                <?php 
                    if ($customer['member'] == 0) {
                        echo "Belum menjadi member";
                        echo "<br>";
                        echo '
                            <a href="#" onclick="freeMember()" style="color:red; font-weight: bolder">Coba Gratis</a>
                        ';
                        echo '<br>';
                    }
                    else {
                        echo "
                        <table width='100%' style='font-size: 14px'>
                            <tr><td>Level</td><td>: &nbsp;</td><td>$customer[jenis_member]</td></tr>
                            <tr><td>Poin</td><td>: &nbsp;</td><td>$customer[poin]</td></tr>
                            <tr><td>Aktif</td><td>: &nbsp;</td><td>".date_format(date_create($customer['tgl_join']), 'd/m/Y')." - ".date_format(date_create($customer['tgl_akhir']), 'd/m/Y')."</td></tr>
                        </table>
                        ";
                    }

                ?>
                <br>
                <div class="panel-bottom">
                    <a href="#popup14" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="background-color:#6C0;">
                        Daftar Member
                    </a> 
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-default">
                <div class="panel-body">
                <h4>Daftar Pesanan Laundry :</h4>
                <p>Tidak ada pesanan</p>
                <button class="btn btn-sm btn-success">Tambah</button>
                <hr>
                <h4>Daftar Pesanan Produk :</h4>
                <p>Tidak ada pesanan</p>
                <button class="btn btn-sm btn-success">Tambah</button>
                <hr>

                <a href="#pop-tagihan" class="btn btn-lg btn-success pull-right"> <i class="icon-plus"></i>Pembayaran</a>
            </div>
        </div>
    </div>


</div>