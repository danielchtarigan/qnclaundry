<?php

include "popup.php";
date_default_timezone_set('Asia/Makassar');

$jam1 = date("Y-m-d");
$id = $_GET['id'];
$ot   = $_SESSION['nama_outlet'];

$qharga = $con->query("SELECT * FROM outlet_harga a, outlet b WHERE a.id_outlet=b.id_outlet AND b.nama_outlet='$ot'");
$hargaot = $qharga->fetch_array();

$idoutlet = $hargaot['id_outlet'];
$levelharga = $hargaot['level_harga'];

$msg = "Belum";

function customer($id) {
    global $con;
    $customers = $con->query("Select * From customer Where id=$id");   
    return $customers;
}

function kuota_lgn($id) {
    global $con;
    $kuotas = $con->query("Select * From langganan Where id_customer=$id");
    $kuota = $kuotas->fetch_array();
    return $kuota;
}

$r = customer($id)->fetch_array();

if($r['jenis_member'] <> 'Red' && $r['tgl_akhir'] >= $jam1) {
    $mb = "1";
    $kl = "0.00004";
    $status="member";
}
else
{
    $mb = "0";
    $kl = "0";
}
if($r['lgn'] == '1'){
    $lg         = "1";
    $sisa_kuota = $r['sisa_kuota'];
    $hargakonversi = kuota_lgn($id)['harga_satuan'];
}
else
{
    $lg         = "0";
    $sisa_kuota = "";
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
    #table-trx tr>td {
        line-height: 20px;
    }
    .invisible {
        visibility: hidden;
    }
    [contenteditable]:focus {
        outline: 2px solid #4685e3 !important;
    }
    .bs-form {
        margin-top: 15px;
        margin-left: 15px;
    }
    .bs-form .control-label {
        text-align: left !important;
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
                    $customer = mysqli_fetch_array(customer($_GET['id']));
                    echo $customer['nama_customer'].' | '.$customer['no_telp'].'<br>'.$customer['alamat'] 
                ?>
                <div class="panel-bottom">
                    <a href="#edit_data" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="background-color:#6C0;">Ubah Data</a>
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
                                <a href="#popup15" onclick="jdlgn()" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="margin-bottom: 5px; background-color:#6C0;">
                                    Daftar Langganan
                                </a>
                            </div>
                        ';
                    }
                    else {
                        $kilo = kuota_lgn($_GET['id']) == 0 ? 0 : kuota_lgn($_GET['id'])['kilo_cks'];
                        $poto = kuota_lgn($_GET['id']) == 0 ? 0 : kuota_lgn($_GET['id'])['potongan'];
                        
                        echo '
                        <table width="100%" style="font-size: 14px" id="table-trx">
                            <tr><td>Cuci Kering Setrika</td><td>: &nbsp;</td><td>'.$kilo.' Kg</td></tr>
                            <tr><td>Potongan</td><td>: &nbsp;</td><td>'.$poto.'</td></tr>
                            <tr><td>Aktif s.d</td><td>: &nbsp;</td><td>'.date_format(date_create(kuota_lgn($_GET['id'])['tgl_expire']), 'd/m/Y').'</td></tr>
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
                    <a href="javascript:">
                        <input type="button" class="btn btn-success" value="Pesanan" id="to_order" style="width:49%; background-color:#6C0;"/>
                    </a>
                    <a href="javascript:">
                        <input type="button" class="btn btn-success" value="Pengambilan" id="take_laundry" style="width:49%; background-color:#6C0;"/>
                    </a>
                    <a href="cari_complain.php" target="_blank">
                        <input type="button" class="btn btn-success" value="Komplain" style="width:49%; margin-top: 5px; background-color:#6C0;"/>
                    </a>
                    <a href="#popupaudit">
                        <input type="button" class="btn btn-success" value="Quality Audit" style="width:49%; margin-top: 5px;; background-color:#6C0;"/>
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
                        <table width='100%' style='font-size: 14px' id='table-trx'>
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

    <div class="col-lg-12" id="r_faktur">
        <div class="panel panel-default">
        <?php
            include "include/daftar_faktur.php";
        ?>
        </div>
    </div>

    <div class="col-lg-12 fr-change-1" id="create_order">
        <div class="panel panel-default">
                <div class="panel-body">
                <h4>Daftar Pesanan Laundry :</h4>
                <?php
                    $id = $_GET['id'];
                    $qkeranjang = mysqli_query($con, "select * from reception where id_customer='$id' and lunas='0'");

                    $nkeranjang = mysqli_num_rows($qkeranjang);
                    $express = false;
                    $struk = "newstruk.php";                    
                    
                    if($nkeranjang > 0) {
                        echo '<table width="50%" style="margin-bottom: 15px">';
                        while ($rkeranjang = mysqli_fetch_array($qkeranjang)){
                            if ($rkeranjang['express']>0) $express = true;
                            $invisible = $rkeranjang['spk']=="0" ? 'normal' : 'invisible';
                            echo '
                                <tr>
                                    <td>'.$rkeranjang['no_nota'].'</td>
                                    <td align="right">
                                        <a href="'.$struk.'?id='.$_GET['id'].'&no_nota='.$rkeranjang['no_nota'].'" target="_blank">
                                            <button type="submit" class="btn btn-default btn-sm">Cetak</button>
                                        </a>
                                        <a href="batal_order.php?id='.$_GET['id'].'&no_nota='.$rkeranjang['no_nota'].'" class="'.$invisible.'">
                                            <button type="submit" class="btn btn-danger btn-sm">Batal</button>
                                        </a>
                                    </td>
                                </tr>';
                        }
                        echo '</table>';

                    }

                    else {
                        echo '<p>Tidak ada pesanan</p>';
                    }

                    ?>
                
                <a href="#laundry_service">
                    <button class="btn btn-sm btn-success">Buat Baru</button>
                </a>
                <hr>
                <h4>Daftar Pesanan Barang :</h4>
                <?php
                $query = $con->query("Select DISTINCT no_order FROM detail_order_item WHERE id_customer='$id' AND no_faktur=''");
                $nData = mysqli_num_rows($query);
                if($nData > 0) {
                    echo '<table width="50%" style="margin-bottom: 15px">';
                    while($data = $query->fetch_array()) {
                        echo '
                                <tr>
                                    <td>'.$data['no_order'].'</td>
                                    <td align="right">
                                        <a href="javascript:">
                                            <button type="submit" class="btn btn-default btn-sm">Cetak</button>
                                        </a>
                                        <a href="batal_order.php?id='.$_GET['id'].'&no_order='.$data['no_order'].'&order_item">
                                            <button type="submit" class="btn btn-danger btn-sm">Batal</button>
                                        </a>
                                    </td>
                                </tr>';
                        }
                        echo '</table>';
                }
                else {
                    '<p>Tidak ada pesanan</p>';
                }

                ?>

                <button class="btn btn-sm btn-success" id="order_item">Buat Baru</button>
                <hr>

                <?php  
                    $inv = $nkeranjang > 0 || $nData > 0 ? 'normal' : 'invisible';
                ?>
                
                <a href="index.php?id=<?= $id ?>&payment#deliveryorder" class="btn btn-lg btn-success pull-right <?= $inv ?>" id="payment"> <i class="icon-plus"></i>Pembayaran</a>
            </div>
        </div>
    </div>

</div>


<!-- popup event click button -->
<div class="popup-wrapper" id="laundry_service">
  <div class="popup-container">
    <div class="row">
        <a href="#" class="timesx"><i class="fa fa-times"></i></a>
        <label class="control-label" style="font-size: 18px">Service Laundry</label>
    </div> 
    <div class="row">
      <a href="index.php?id=<?= $id ?>&jenis=Kiloan#layanan" class="popup-link">
      <input type="button" class="btn btn-success col-xs-6" data-id="" value="Kiloan" id="" style="background-color:#FFF; color:#6C0;">
      </a>
      <a href="index.php?id=<?= $id ?>&jenis=Potongan#potongan" class="popup-link">
      <input type="button" class="btn btn-success col-xs-6" data-id="" value="Potongan" id="" style="background-color:#FFF; color:#6C0">
      </a>
    </div>  
  </div>
</div>

<div class="popup-wrapper" id="edit_data" style="top: 48px">
	<div class="popup-container">
		<?php include 'data_customer.php'; ?>
    </div>
</div>

<div class="popup-wrapper" id="popup13">
    <div class="popup-container">
        <div class="modal-header">
            Deposit Langganan
        </div>
        <div class="modal-body">
            <form method="GET" action="javascript:" id="" class="form-horizontal">
                <input type="hidden" readonly class="form-control" autocomplete="off" name="kuota_kilo" id="kuota_kilo" value="<?php echo kuota_lgn($id)['kilo_cks']; ?>"/>   
                <input type="hidden" readonly class="form-control" autocomplete="off" name="sisa_kuota" id="sisa_kuota" value="<?php echo kuota_lgn($id)['all_kuota']; ?>"/>
                <input type="hidden" readonly class="form-control" autocomplete="off" name="kuota_pot" id="kuota_pot" value="<?php echo kuota_lgn($id)['potongan']; ?>"/> 
                <input type="hidden" readonly class="form-control" autocomplete="off" name="id" id="sisa_kuota" value="<?php echo $_GET['id']; ?>"/>

                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="paket">
                            Pilih Paket
                        </label>
                        <div class="col-xs-6" >
                            <select class="form-control" name="paket" id="paket">
                                <option value="">--</option>
                                <option value="hemat_50">
                                Paket Hemat 50Kg
                                </option>
                                <option value="kilo30">
                                All Kiloan 30kg
                                </option>        
                                <option value="singgle">
                                Paket Single
                                </option>
                                <option value="family">
                                Paket Family
                                </option>
                                <option value="custom">
                                Custom
                                </option>
                            </select>
                        </div><br>
                    </div>
                    <input type="hidden" readonly class="form-control" autocomplete="off" name="npaket" id="npaket"/>
                    <div class="form-group">
                        <label for="hargapaket" class="control-label col-xs-3">
                            Harga Paket
                        </label>
                        <div class="col-xs-4" >
                            <input type="text" class="form-control" autocomplete="off" name="hargapaket" id="hargapaket" />
                        </div><br>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="carabayarlgn">
                            Cara Bayar
                        </label>
                        <div class="col-xs-4" >
                            <select class="form-control" name="carabayarlgn" id="carabayarlgn">
                                <option value="cash">
                                Cash
                                </option>
                                <option value="edcbca">
                                Edc BCA
                                </option>
                                <option value="edcmandiri">
                                Edc Mandiri
                                </option>
                                <option value="edcbri">
                                Edc BRI
                                </option>
                                <option value="edcbni">
                                Edc BNI
                                </option>
                            </select>
                        </div><br>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer">
            <input type="button" id="form-input-deposit" class="btn btn-success btkiloan" value="Simpan" style="width:49%; background-color:#FFF; color:#6C0;"/>
            <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                <input type="button" class="btn btn-success btpotongan" value="Selesai" style="width:49%; background-color:#FFF; color:#fd2121"/>
            </a>
        </div>
        <a class="popup-close" href=""><img src="back.png" /></a>
        <br />
    </div>
</div>

<!-- Membership -->
<div class="popup-wrapper" id="popup14">
    <div class="popup-container">
        <div class="modal-header">
            Membership
        </div>
        <div class="modal-body" width="100%">
            <form method="GET" action="javascript:" id="" class="form-horizontal" target="_blank">
                <input type="hidden" name="id_cs" id="id_cs" value="<?php echo $_GET['id']; ?>">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="jenis_member">
                            <p align="left">Jenis</p>
                        </label>
                        <div class="col-xs-9" >
                            <select class="form-control" name="jenis_member" id="jenis_member" onchange="pilih_jenis()">
                                <option value="">
                                    Pilih Membership
                                </option>
                                <option value="blue3bulan">
                                    Blue 3 Bulan
                                </option>
                                <option value="blue6bulan">
                                    Blue 6 Bulan
                                </option>
                                <option value="blue12bulan">
                                    Blue 12 Bulan
                                </option>
                                <option value="Red">
                                    RED
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_telp" class="control-label col-xs-3">
                            <p align="left">Tgl Akhir</p>
                        </label>
                        <div class="col-xs-9">
                            <input type="text" readonly required name="tgl_akhir" class="form-control" id="tgl_akhir">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hargapaket" class="control-label col-xs-3">
                            <p align="left">Harga Paket</p>
                        </label>
                        <div class="col-xs-9" >
                            <input type="text" class="form-control" autocomplete="off" name="hargamember" id="hargamember" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="carabayarlgn">
                            <p align="left">Cara Bayar</p>
                        </label>
                        <div class="col-xs-9" >
                            <select class="form-control" name="carabayarmbr" id="carabayarmbr">
                                <option value="cash">
                                    Cash
                                </option>
                                <option value="edcbca">
                                    Edc BCA
                                </option>
                                <option value="edcmandiri">
                                    Edc Mandiri
                                </option>
                                <option value="edcbri">
                                    Edc BRI
                                </option>
                                <option value="edcbni">
                                    Edc BNI
                                </option>
                            </select>
                        </div>
                    </div>
                </fieldset>

            </form>
        </div>
        <div class="modal-footer">
            <input type="button" id="form-input-membership" class="btn btn-success btpotongan" style="width:49%; background-color:#FFF; color:#6C0" value="Simpan"/>
            <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
            </a>
        </div>
        <a class="popup-close" href=""><img src="back.png" />
        </a>
        <br />
    </div>
</div>

<div id="printmbr"></div>


<!-- QA -->
<div class="popup-wrapper" id="popupaudit" style="top: 20px">
	<div class="popup-container">
                        <div class="panel-heading" align="center">
                          <strong>QUALITY AUDIT</strong>
                        </div>
<form method="get" action="act/act_quality_audit.php">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <?php
   $audit = mysqli_query($con, "select * from reception where id_customer='$_GET[id]' and ambil='1' order by id desc limit 0,1");
   $raudit = mysqli_fetch_array($audit);
  ?>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Nama Customer
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="text" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $raudit['nama_customer']; ?>" readonly="readonly"/>
                                                                 </div>

                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                No Nota
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="text" class="form-control" name="no_nota" id="no_nota" value="<?php echo $raudit['no_nota']; ?>" readonly="readonly"/>                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Tanggal Ambil
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="text" class="form-control" name="tgl_ambil" id="tgl_ambil" value="<?php echo $raudit['tgl_ambil']; ?>" readonly="readonly"/>                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Kebersihan
                                                        </label>
                                                        <div class="col-xs-6" for="voucher" >
                                                             <input type="radio" value="1" name="kebersihan" id="kebersihan" checked="checked"/> 1
                                                             <input type="radio" value="2" name="kebersihan" id="kebersihan"/> 2
                                                             <input type="radio" value="3" name="kebersihan" id="kebersihan"/> 3
                                                             <input type="radio" value="4" name="kebersihan" id="kebersihan"/> 4
                                                             <input type="radio" value="5" name="kebersihan" id="kebersihan"/> 5
                                                         <br /><br />
                                                         </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-xs-4" for="voucher">
                                                                Keharuman
                                                        </label>
                                                        <div class="control-label col-xs-6" for="voucher" >
                                                                <input type="radio" value="1" name="keharuman" id="keharuman" checked="checked"/> 1
                                                                <input type="radio" value="2" name="keharuman" id="keharuman"/> 2
                                                                <input type="radio" value="3" name="keharuman" id="keharuman"/> 3
                                                                <input type="radio" value="4" name="keharuman" id="keharuman"/> 4
                                                                <input type="radio" value="5" name="keharuman" id="keharuman"/> 5
                                                         <br /><br />
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Kerapian
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="radio" value="1" name="kerapian" id="kerapian" checked="checked"/> 1
                                                                <input type="radio" value="2" name="kerapian" id="kerapian"/> 2
                                                                <input type="radio" value="3" name="kerapian" id="kerapian"/> 3
                                                                <input type="radio" value="4" name="kerapian" id="kerapian"/> 4
                                                                <input type="radio" value="5" name="kerapian" id="kerapian"/> 5
                                                         <br /><br />
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Ketepatan Waktu
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="radio" value="Ya" name="waktu" id="waktu" checked="checked"/> Ya
                                                                <input type="radio" value="Tidak" name="waktu" id="waktu"/> Tidak
                                                         <br /><br />
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Ketepatan Jumlah
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="radio" value="Ya" name="jumlah" id="jumlah" checked="checked"/> Ya
                                                                <input type="radio" value="Tidak" name="jumlah" id="jumlah"/> Tidak
                                                         <br /><br />
                                                        </div>
                                                </div>
                                                <br /><br />
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4">
                                                                Kritik dan Saran
                                                        </label>
                                                        <div class="control-label col-xs-6">
                                                                <textarea name="kritik" id="kritik" class="form-control"></textarea>
                                                         <br />
                                                        </div>
                                                </div>
                                                <br /><br />

                                        <input type="submit" class="btn btn-success btkiloan" value="Simpan" style="width:49%; background-color:#FFF; color:#6C0;"/>
                                        <a href="#" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
										</form>
    </div>
</div>

<div class="popup-wrapper" id="new_item_order" style="top: 40px;">
    <div class="popup-container" style="padding: 15px">
        <a href="#" class="timesx"><i class="fa fa-times"></i></a>
        <h4>Pesanan Barang</h4>
        <div class="form-horizontal bs-form" id="input_item">
            <div class="form-group bs-input-group">
                <label for="total" class="control-label col-lg-2">Total</label>
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input type="text" class="form-control" id="total" readonly value="0">
                    </div>
                </div>
                <button type="button" class="btn btn-default" id="calc_item">Kalkulasi</button>
            </div>
            <div class="form-group bs-input-group">
                <label for="item" class="control-label col-lg-2">Barang</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="item" placeholder="Ketik nama barang di sini..." autocomplete="off">
                </div>
                <button type="button" class="btn btn-success" onclick="window.location.href='#add_new_item'">Barang Baru</button>
            </div>
        </div>

        <table width="100%" class="table table-bordered" style="color: #fff; font-size: 12px" id="table_item">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Deskripsi Barang</th>
                    <th>Harga Satuan</th>
                    <th>Kts</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button class="btn btn-success" id="save_order">Simpan</button>
        <button class="btn btn-default">Print</button>
    </div>
</div>

<div class="popup-wrapper" id="add_new_item" style="top: 40px;">
    <div class="popup-container" style="padding: 15px">
        <a href="#" class="timesx"><i class="fa fa-times"></i></a>
        <h4>Tambah Barang</h4>
        <div class="form-horizontal bs-form" id="input_new_item">
            <div class="form-group bs-input-group">
                <label for="code" class="control-label col-lg-4">Kode</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="code" readonly>
                </div>
                <button type="button" class="btn btn-default" id="gen_code">Auto</button>
            </div>
            <div class="form-group bs-input-group">
                <label for="item_desc" class="control-label col-lg-4">Deskripsi Barang</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="item_desc" placeholder="Ketik nama barang di sini..." autocomplete="off">
                </div>
            </div>
            <div class="form-group bs-input-group">
                <label for="price" class="control-label col-lg-4">Harga Satuan</label>
                <div class="col-lg-4">
                <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input type="text" class="form-control" id="price" onkeypress="return validnumber(event)" placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-group bs-input-group">
                <label for="qty" class="control-label col-lg-4">Kuantitas</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" id="qty" disabled onkeypress="return validnumber(event)" placeholder="" autocomplete="off">
                </div>
            </div>
        </div>
        <button class="btn btn-success" id="save">Simpan & Kembali</button>
    </div>
</div>

<!-- Script halaman ini -->
<script>
    jQuery(function($) {
        $('body').scrollTop('0');
        $('#create_order').hide();
        $('#to_order').on('click', function (e) {
            $('#r_faktur').hide()
            $('#create_order').slideDown();
            $('body').animate({ 
                scrollTop : $('#create_order').offset().top - 170
            })
        });

        $('#create_order button').on('click', function (e) {
            $('body').animate({ 
                scrollTop : 0
            }, 890)
        });

        $('#take_laundry').on('click', function (e) {
            $('#create_order').hide();
            $('#r_faktur').load('include/cari_ambil.php').slideDown();
            $('body').animate({ 
                scrollTop : $('#r_faktur').offset().top - 170
            })
        })
    });

    // Tambah Barang Baru
    function validnumber(e){
        var charCode = (e.which) ? e.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
    }

    $('#input_new_item').on('click', '#gen_code', function () {
        var form = $('#input_new_item');
        $.ajax({
            url: 'include/bs_gen_code.php',
            success: function(resData) {
                form.find('#code').val(resData);
            }
        });
    })

    $('#add_new_item').on('click', '#save', function() {
        form = $('#input_new_item');
        var item = form.find('#code').val();
        var desc = form.find('#item_desc').val();
        var price = form.find('#price').val();
        var data = {
            item:item, desc:desc, price:price
        };
        if (item == "") {
            alert("Item tidak boleh kosong ya..");
        }
        else if (desc == "") {
            alert("Deskripsi barang tidak boleh kosong ya..");
        }
        else if (price == "") {
            alert("Harga tidak boleh kosong ya..");
        }
        else {
            $.ajax({
                url: 'act/bs_save_new_item.php',
                method: 'POST',
                data: data,
                success: function (resData) {
                    window.location.href = resData;
                }
            })
        }
    })
    

    // Akhir Tambah Barang Baru

    // Penjualan Barang di Toko
    $('#order_item').on('click', function () {
        location.href = '#new_item_order';
    });

    $('#item').on('keyup', function (e) {
        $('#item').closest('.bs-input-group').find('.list-group').hide();
        var item = $(this).val();
        if (item.length >= 3) {
            $.ajax({
                url: 'include/bs_list_item.php',
                dataType: 'html',
                data: 'item='+item,
                success: function (resData) {
                    $('#item').after(resData);
                    $('#item').closest('.bs-input-group').find('.list-group a').on('click', function (e) {
                        $('#item').val('');
                        $('#item').closest('.bs-input-group').find('.list-group').hide();
                        var item = $(this).data('id');
                        var item_desc = $(this).data('desc');
                        var price = $(this).data('price');
                        var qty = 1;
                        var amount = parseInt(qty*price);
                        id = parseInt(item);
                        var newRow = '<tr id="item'+id+'"><td>'+item+'</td><td>'+item_desc+'</td><td>'+price+'</td><td id="kts'+id+'" onfocus="edit_row_item('+id+')" onblur="edit_row_item('+id+')" onclick="edit_row_item('+id+')">'+qty+'</td><td id="amount'+id+'">'+amount+'</td></tr>';
                        $('#table_item tbody').append(newRow);
                        item_calculation();            
                    })
                }
            });
        }        
    })

    function edit_row_item(i) {
        var id = i;  
        var kts = $('#table_item tbody>tr#item'+id+'>td:eq(3)').attr('contenteditable', true);
        var price = $('#table_item tbody>tr#item'+id+'>td:eq(2)').text();
        var kts = $('#table_item tbody>tr#item'+id+'>td:eq(3)').text();
        var amount = parseInt(price*kts);
        $('#table_item tbody>tr#item'+id+'>td:eq(4)').text(amount); 
        item_calculation();
    }    
    
    $('#input_item #calc_item').click(function () { 
        item_calculation();
    })

    function item_calculation() {        
        calc = 0;
        $('#table_item tbody>tr').each(function () {
            var sum = parseInt($(this).find('td:eq(4)').text());
            if (!isNaN(sum)) {
                calc += sum;
            }
        })   
        var calc = calc.toLocaleString("id-ID");
        $('#input_item #total').val(calc);
    }

    $('#new_item_order').on('click', '#save_order', function () {
        var total = $('#input_item #total').val();
        if(total > 0) {
            id = '<?= $id ?>';
            var TableData = new Array();    
            $('#table_item tr').each(function(row, tr){
                TableData[row]={
                    "item" : $(tr).find('td:eq(0)').text(), 
                    "price" : $(tr).find('td:eq(2)').text(),
                    "qty" : $(tr).find('td:eq(3)').text(),
                    "amount" : $(tr).find('td:eq(4)').text(),
                    "id_customer" : '<?= $_GET['id'] ?>'

                }
            }); 
            TableData.shift();
            var myJson = JSON.stringify(TableData);
            $.ajax({
                method: 'POST',
                url: 'act/bs_order_item.php',
                data: myJson,
                dataType: 'json',
                contentType: 'application/json',
            });

            location.href = 'index.php?id='+id;
        }
        
    })
    
    // Akhir Penjualan Barang di Toko
    

    function freeMember(){
		if(confirm("Anda mengizinkan Customer menjadi Membership gratis 1 bulan, Diskon 20% setiap pemesanan"))
		{
			var id = '<?= $id ?>';
			$.ajax({
				url 	: 'act/membership_free.php',
				data 	: 'id='+id,
				method	: 'POST',
				success : function(data)
				{
					alert(data);
					location.href = "";
				}
			})
		}
	}

    function jdlgn() {
        if (confirm("Yakin jadikan Langganan?"))
			{
				var id_cs = '<?= $id ?>';
				var data = "id_cs=" + id_cs ;
				$.ajax({
                    type: "POST",
                    url: "update_lgn.php",
                    data: data,
                    cache: false,
                    success: function()
                    {
                        location.reload();
                    }
                })
			}
    }

    // Deposit langganan
    $("#paket").change(function()
	{
		var paket = $("#paket").val();

		if(paket=="hemat_50")
			{
				$("#hargapaket").val(350000);
				$("#npaket").val(50);

			} 

		else if(paket=="kilo30")
			{
				$("#hargapaket").val(265000);
				$("#npaket").val(30);

			} 
		else if(paket=="singgle")
			{
				$("#hargapaket").val(275000);
				$("#npaket").val(20);
			} 
		else if(paket=="family")
			{
				$("#hargapaket").val(715000);
				$("#npaket").val(50);
			}
	});

	$('#form-input-deposit').on('click', function(){
		id = "<?= $_GET['id'] ?>";
		hargapaket = $('#hargapaket').val();
		paket = $('#paket').val();
		carabayarlgn = $('#carabayarlgn').val();
		npaket = $('#npaket').val();
		kuota_kilo = $('#kuota_kilo').val();
		sisa_kuota = $('#sisa_kuota').val();
		kuota_pot = $('#kuota_pot').val();

		$.ajax({
			url 	: 'act/act_deposit.php',
			data 	: {
				id 				: id,
				hargapaket 		: hargapaket,
				paket 			: paket,
				carabayarlgn 	: carabayarlgn,
				npaket 			: npaket,
				kuota_kilo 		: kuota_kilo,
				sisa_kuota 		: sisa_kuota,
				kuota_pot 		: kuota_pot
			},
            beforeSend: function () {
                $(".modal-body").html('Proses...');
            },
			success : function(msg){
				$(".modal-body").html('<b>Paket kuota berhasil ditambahkan!</b>');
				$('.modal-footer').html(msg);

                $('.modal-footer a.cetak-f').click(function (){
                    loc = 'index.php?id='+id;
                    location.href = loc;
                });

			}	
		})

	});


    // Membership
    $('#form-input-membership').on('click', function(){
		id_cs = "<?= $_GET['id'] ?>";
		jenis_member = $('#jenis_member').val();
		hargamember=$("#hargamember").val();
		carabayarmbr = $('#carabayarmbr').val();
		tgl_akhir = $('#tgl_akhir').val();

		if ( jenis_member == "" )
		{
			alert("Pilih Paket");
			$("#jenis_member").focus();
			return false;
		}
		if ( hargamember == "" )
		{
			alert("harga Paket masih kosong");
			$("#hargamember").focus();
			return false;
		}

		$.ajax(
		{
			url:"act/act_member.php",
			data:"id_cs="+id_cs+"&hargamember="+hargamember+"&jenis_member="+jenis_member+"&carabayarmbr="+carabayarmbr+"&tgl_akhir="+tgl_akhir,
            beforeSend: function () {
                $(".modal-body").html('Proses...');
            },
			success:function(msg)
			{
				$(".modal-body").html('<b>Membership berhasil ditambahkan</b>');
				$('.modal-footer').html(msg);
                $('.modal-footer a.cetak-f').click(function (){
                    loc = 'index.php?id='+id;
                    location.href = loc;
                });
			}
		})

	})

	function pilih_jenis()
		{
			var i = '<?php
			$d=strtotime("+3 Months");
			echo  date("Y-m-d", $d); ?>';
			var d = '<?php
			$s=strtotime("+6 Months");
			echo  date("Y-m-d", $s); ?>';

			var e = '<?php
			$f=strtotime("+12 Months");
			echo  date("Y-m-d", $f); ?>';

			var jenis_member = $("#jenis_member").val();
            
			if(jenis_member=="blue3bulan")
			{
				$("#tgl_akhir").val(i);
				$("#hargamember").val("100000");

			}else if(jenis_member=="blue6bulan")
			{
				$("#tgl_akhir").val(d);
				$("#hargamember").val("150000");
			}else if(jenis_member=="blue12bulan" || jenis_member=="red")
			{
				$("#tgl_akhir").val(e);
				$("#hargamember").val("250000");
			}else
			{
				$("#tgl_akhir").val("");
				$("#hargamember").val("");
			}

		};


        // DeliveryOrder
        function deliveryform() {
            $('#deliveryorder').css('top', '0');
            $('#tombol-delivery').css('background-color','#ddf8c2');
            $('#form-delivery').show();
        }

        function closedeliverypopup() {
            $('#deliveryorder').css('display','none');
        }
        $('#selesai-button').click(function() {
            $('#deliveryorder').css('display','block');
        });
        
        $(function(){
            $("#tglantar").datepicker({
                format:'dd/mm/yyyy',
                autoclose: true,
                <?php if ($express) echo "startDate: '+1d'"; else echo "startDate: '+3d'"; ?>,
            });
        });


</script>

<?php

// if (isset($_GET['jenis'])) {
    include 'include/inc_transaksi.php';
// }
if (isset($_GET['payment'])){
    include "form/bs_payment.php";
}
elseif (isset($_GET['deliveryorder'])) {
    include "form/bs_delivery_order.php";
}