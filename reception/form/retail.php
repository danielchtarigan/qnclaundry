<?php 
include 'popup.php';

if(empty($_SESSION['nama_outlet'])) {
  header("location: ../index.html");
}
?>

<script type="text/javascript">
function startCalculate1(){
interval=setInterval("Calculate1()",10);
}
function Calculate1(){
  var i;
  var a=document.form2.itemretail1.value.substr(5,10);
  var b=document.form2.jumlah1.value;
  document.form2.harga1.value=(a*b);
}
function stopCalc1(){
clearInterval(interval);
}
function startCalculate2(){
interval=setInterval("Calculate2()",10);
}
function Calculate2(){
  var i;
  var a=document.form2.itemretail2.value.substr(5,10);
  var b=document.form2.jumlah2.value;
  document.form2.harga2.value=(a*b);
}
function stopCalc2(){
clearInterval(interval);
}
function startCalculate3(){
interval=setInterval("Calculate3()",10);
}

function Calculate3(){
  var i;
  var a=document.form2.itemretail3.value.substr(5,10);
  var b=document.form2.jumlah3.value;
  document.form2.harga3.value=(a*b);
}

function stopCalc3(){
clearInterval(interval);
}


</script>

<?php $qdelivery = mysqli_query($con,"SELECT no_telp,alamat,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan,waktu_permintaan,catatan FROM delivery WHERE id_customer='$_GET[id]' AND no_faktur IS NULL AND jenis_permintaan='Antar' ORDER BY tgl_input DESC LIMIT 1");
if (mysqli_num_rows($qdelivery)>0) {
  $delivery = mysqli_fetch_array($qdelivery); ?>
<div class="col-xs-12">
<div class="panel panel-default">
    <div class="panel-heading">
      Data Delivery
    </div>
    <div class="panel-body">
      <b>No. Telepon:</b> <?php echo $delivery['no_telp']; ?>
      <br>
      <b>Alamat:</b> <?php echo $delivery['alamat']; ?>
      <br>
      <b>Tanggal:</b> <?php echo $delivery['tgl_permintaan']; ?>
      <br>
      <b>Waktu:</b> <?php echo $delivery['waktu_permintaan']; ?>
      <br>
      <b>Catatan:</b> <?php echo $delivery['catatan']; ?>
  </div>
</div>
</div>
<?php } ?>
        <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php $tgl = date("Y-m-d");?>
                            <font color="#009900"> Perlu transaksi retail? Jika tidak, klik pembayaran untuk mengakhiri transaksi.
                            </font>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">

<table style="font-size:10pt; width:100%;">
              <tr>
                                <td>&nbsp;</td>
                                <td>JUMLAH</td>
                                <td>NAMA BARANG</td>
                                <td></td>
                                <td>HARGA
                                </td>
                                <td></td>
                            </tr>
      <?php
      if (isset($_GET['faktur'])){
            $qretail = mysqli_query($con, "select * from detail_retail a, retail b where a.item=b.kode and a.no_faktur='$_GET[faktur]' and lunas='0'");
      $nretail = mysqli_num_rows($qretail);
      $totalretail = 0;
      if ($nretail>0){
        $totalretail = 0;
      while ($rretail = mysqli_fetch_array($qretail)){
      ?>
              <tr>
                                <td>&nbsp;</td>
                                <td><?php echo $rretail['jumlah']; ?></td>
                                <td><?php echo $rretail['nama_barang']; ?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($rretail['total'],0,',','.');?>
                                </td>
                                <td><a href="batal_retail.php?id=<?php echo $rretail['id']; ?>"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
      <?php
      $totalretail = $totalretail+$rretail['total'];
      }
      }
      }
      else{

        }
      ?>

</table>
<br /><br />

<form id="form2" name="form2" method="get" action="act_retail.php">

<table style="font-size:10pt; width:100%;">

 <tr><td align="center">ITEM RETAIL</td><td align="center">JUMLAH</td><td colspan="2" align="center">HARGA</td></tr>
 <tr>
  <td>
  <input type="hidden" name="id_cust" value="<?php echo $_GET['id']; ?>" />
                                                 <select name="itemretail1" class="form-control" onfocus="startCalculate1()" onblur="stopCalc1()">
                                                  <option value="">Pilih Item Retail</option>
                          <?php
                                                   $qitem = mysqli_query($con, "select * from retail");
                             while ($ritem = mysqli_fetch_array($qitem)){
                                                ?>
                                                     <option value="<?php echo $ritem['kode']."-".$ritem['harga']; ?>">
                                                       <?php echo $ritem['nama_barang']." - Rp.".$ritem['harga']; ?>
                                                     </option>
                        <?php
                         }
?>
                                                 </select>
  </td>
  <td><input type="text" value="0" name="jumlah1" id="jumlah1" class="form-control" style="width:40px;" onfocus="startCalculate1()" onblur="stopCalc1()"/></td>
  <td>Rp. </td>
  <td><input type="text" value="0" name="harga1" id="harga1" class="form-control" readonly="readonly"/></td>
 </tr>

 <tr>
  <td>
                                                 <select name="itemretail2" class="form-control" onfocus="startCalculate2()" onblur="stopCalc2()">
                                                  <option value="">Pilih Item Retail</option>
                          <?php
                                                   $qitem = mysqli_query($con, "select * from retail");
                             while ($ritem = mysqli_fetch_array($qitem)){
                                                ?>
                                                     <option value="<?php echo $ritem['kode']."-".$ritem['harga']; ?>">
                                                       <?php echo $ritem['nama_barang']." - Rp.".$ritem['harga']; ?>
                                                     </option>
                        <?php
                         }
?>
                                                 </select>
  </td>
  <td><input type="text" value="0" name="jumlah2" id="jumlah2" class="form-control" style="width:40px;" onfocus="startCalculate2()" onblur="stopCalc2()"/></td>
  <td>Rp. </td>
  <td><input type="text" value="0" name="harga2" id="harga2" class="form-control" readonly="readonly"/></td>
 </tr>

 <tr>
  <td>
                                                 <select name="itemretail3" class="form-control" onfocus="startCalculate3()" onblur="stopCalc3()">
                                                  <option value="">Pilih Item Retail</option>
                          <?php
                                                   $qitem = mysqli_query($con, "select * from retail");
                             while ($ritem = mysqli_fetch_array($qitem)){
                                                ?>
                                                     <option value="<?php echo $ritem['kode']."-".$ritem['harga']; ?>">
                                                       <?php echo $ritem['nama_barang']." - Rp.".$ritem['harga']; ?>
                                                     </option>
                        <?php
                         }
?>
                                                 </select>
  </td>
  <td><input type="text" value="0" name="jumlah3" id="jumlah3" class="form-control" style="width:40px;" onfocus="startCalculate3()" onblur="stopCalc3()"/></td>
  <td>Rp. </td>
  <td><input type="text" value="0" name="harga3" id="harga3" class="form-control" readonly="readonly"/></td>
 </tr>
 <tr>
  <td colspan="4" align="right">&nbsp;</td>
 </tr>
 <tr>
  <td colspan="4" align="right"><input type="submit" value="Simpan" /></td>
 </tr>

</table>
</form>
                                    <br />
                                 <!--    <button class="btn btn-lg btn-success pull-right" data-id='0' data-toggle="modal" data-target="#tambah-data"> <i class="icon-plus"></i>Pembayaran</button> -->
                              
                                  <a href="#pop-tagihan" class="btn btn-lg btn-success pull-right"> <i class="icon-plus"></i>Pembayaran</a>
                                
      </div>
    </div>
  </div>
</div>
</div>


<!-- Start -->

<?php 
include 'code.php';
$idcs = $id;
$lgn = ($r['lgn']=="1") ? "1" : "0";

$hargakonversi = round($hargakonversi);
$hargakonversiss = round($hargakonversi*0.7);
$hargakonversickl = round($hargakonversi*0.6);
$hargakonversick = round($hargakonversi*0.3);


function penjualan($idcs,$jenis) {
  global $con;
  $sql = $con->query("SELECT COALESCE(SUM(total_bayar),0) as total from reception where id_customer='$idcs' and lunas='0' and jenis='$jenis'");
  $hasil = $sql->fetch_array();
  return $hasil[0];
}

function penjualan2($idcs) {
  global $con;
  $sql = $con->query("SELECT COALESCE(SUM(total),0) as total from detail_retail where id_customer='$idcs' and lunas='0'");
  $hasil = $sql->fetch_array();
  return $hasil[0];
}

function sisa_kiloan($idcs){
  global $con;
  $sql = $con->query("SELECT COALESCE(kilo_cks,0) as total from langganan where id_customer='$idcs'");
  $hasil = $sql->fetch_array();
  return $hasil[0];
}

function sisa_potongan($idcs){
  global $con;
  $sql = $con->query("SELECT COALESCE(potongan,0) as total from langganan where id_customer='$idcs'");
  $hasil = $sql->fetch_array();
  return $hasil[0];
}


$kiloan = penjualan($idcs,'k');
$potongan = penjualan($idcs,'p');
$lain = penjualan2($idcs);

$total = $kiloan+$potongan+$lain;

?>


<div class="popup-wrapper" id="pop-tagihan" style="top: 40px">
  <div class="popup-container">
    <div class="popup-form">
      <h2 align="center">Tagihan</h2>
    </div>
    
    <form class="form-horizontal">
      <div style="margin: 2% auto; position: relative; padding: 20px 30px; background-color: #5ab400; color:#fff; border-radius: 3px;">
         <div class="form-group"> 
          <label class="control-label col-xs-6"><p align="left">Kiloan</p></label>      
          <div class="col-xs-6">
            <input class="form-control" type="text" name="" value="Rp. <?= number_format($kiloan,2,',','.') ?>" readonly="">
          </div>  
        </div>
        <div class="form-group"> 
          <label class="control-label col-xs-6"><p align="left">Potongan</p></label>      
          <div class="col-xs-6">
            <input class="form-control" type="text" name="" value="Rp. <?= number_format($potongan,2,',','.') ?>" readonly="">
          </div>  
        </div>
        <div class="form-group"> 
          <label class="control-label col-xs-6"><p align="left">Lain-Lain</p></label>      
          <div class="col-xs-6">
            <input class="form-control" type="text" name="" value="Rp. <?= number_format($lain,2,',','.') ?>" readonly="">
          </div>  
        </div>
      </div>
       
      <div class="form-group"> 
        <label class="control-label col-xs-6"><p align="left">Total</p></label>      
        <div class="col-xs-6">
          <input class="form-control" type="text" name="" value="Rp. <?= number_format($total,2,',','.') ?>" id="total1" readonly="" style="font-weight: bolder">
        </div>  
      </div>
    </form>

    <a href="#pop-cara-bayar" class="popup-link">
    <input type="button" class="btn btn-success col-xs-6" value="Cara Bayar" style="background-color:#FFF; color:#6C0"/>
    </a>
    <a href="index.php?id=<?php echo $_GET['id'];?>&selesai=ya" class="popup-link">
    <input type="button" class="btn btn-success col-xs-6" value="Batal" style="background-color:#FFF; color:#6C0"/>
    </a>
    <br><br>

  </div>
</div>


<div class="popup-wrapper" id="pop-pembayaran" style="top: 20px">
  <div class="popup-container">
    <div class="popup-form">
      <h2 align="center">Pembayaran</h2>
    </div>
    <form class="form-horizontal" action="act/pembayaran.php" method="POST">
      <input class="hidden" type="text" id="faktur" name="idFaktur" value="<?= $nofaktur ?>">
      <input class="hidden" type="text" name="idcs" value="<?= $_GET['id'] ?>">
      <input class="hidden" type="text" id="kodevoucher2" name="kodevoucher2">
      <div class="form-group"> 
        <label class="control-label col-xs-6"><p align="left">Tagihan</p></label>      
        <div class="col-xs-6">
          <input class="form-control" type="text" name="tagihan" value="<?= $total ?>" id="tagihan" data-a-dec="," data-a-sep="." readonly="" style="font-weight: bolder" onfocus="startH()" onblur="endH()">
        </div>  
      </div>

      <div style="margin: 2% auto; position: relative; padding:20px 30px; background-color: #5ab400; color:#fff; border-radius: 3px;">
        <div class="form-group hidden" id="daricash"> 
          <label class="control-label col-xs-6"><p align="left" id="cb1">Cash</p></label>    
          <div class="col-xs-6">
            <input class="form-control" id="nilaicash" type="text" name="nilaicash" value="0" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div>
        </div>
        <div class="form-group hidden" id="daricashb"> 
          <label class="control-label col-xs-6"><p align="left" id="cb1">Cashback</p></label>      
          <div class="col-xs-6">
            <input class="form-control" id="nilaicashb" type="text" name="nilaicashb" readonly="" value="0" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div>  
        </div>
        <div class="form-group hidden" id="daribni"> 
          <label class="control-label col-xs-6"><p align="left" id="cb1">BNI</p></label>      
          <div class="col-xs-6">
            <input class="form-control" id="nilaibni" type="text" name="nilaibni" value="0" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div>  
        </div>
        <div class="form-group hidden" id="daribri"> 
          <label class="control-label col-xs-6"><p align="left" id="cb1">BRI</p></label>      
          <div class="col-xs-6">
            <input class="form-control" id="nilaibri" type="text" name="nilaibri" value="0" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div>  
        </div>
        <div class="form-group hidden" id="daribca"> 
          <label class="control-label col-xs-6"><p align="left" id="cb1">BCA</p></label>      
          <div class="col-xs-6">
            <input class="form-control" id="nilaibca" type="text" name="nilaibca" value="0" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div>  
        </div>
        <div class="form-group hidden" id="darimandiri"> 
          <label class="control-label col-xs-6"><p align="left" id="cb1">Mandiri</p></label>      
          <div class="col-xs-6">
            <input class="form-control" id="nilaimandiri" type="text" name="nilaimandiri" value="0" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div>  
        </div>
        <div class="form-group hidden" id="dariovo"> 
          <label class="control-label col-xs-6"><p align="left" id="cb1">OVO</p></label>      
          <div class="col-xs-6">
            <input class="form-control" id="nilaiovo" type="text" name="nilaiovo" value="0" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div>  
        </div>
        <div class="form-group hidden" id="darigopay"> 
          <label class="control-label col-xs-6"><p align="left" id="cb1">GO-Pay</p></label>      
          <div class="col-xs-6">
            <input class="form-control" id="nilaigopay" type="text" name="nilaigopay" value="0" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div>  
        </div>
        <div class="form-group hidden" id="darikuota1"> 
          <div class="col-xs-3">
            <input class="form-control" id="kuotacks" type="text" name="kuotacks" value="" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()"><span style="font-size: 9px">CKS - Kg</span>
          </div>  
           <div class="col-xs-3">
            <input class="form-control" id="kuotackl" type="text" name="kuotackl" value="" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()"><span style="font-size: 9px">CKL - Kg</span>
          </div> 
          <div class="col-xs-3">
            <input class="form-control" id="kuotack" type="text" name="kuotack" value="" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()"><span style="font-size: 9px">CK - Kg</span>
          </div>  
           <div class="col-xs-3">
            <input class="form-control" id="kuotass" type="text" name="kuotass" value="" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()"><span style="font-size: 9px">Setrika - Kg</span>
          </div> 
        </div>
        <div class="form-group hidden" id="darikuota2"> 
          <div class="col-xs-6">
            <input class="form-control" id="kuotaP" type="text" name="kuotaP" value="" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()"><span style="font-size: 9px">Potongan - Rp</span><br><span style="font-size: 11px; color: yellow"><strong>Info: </strong>Charge Express, Hanger, dan Plastik tidak bisa dibayar dengan kuota<br>Silahkan pilih pembayaran lain!!</span>
          </div>   
          <div class="col-xs-6">
            <input class="form-control" id="nilaikuota" type="text" name="nilaikuota" readonly="" value="" placeholder="0" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
          </div> 
        </div>
          
        
        <div class="form-group" id="tambahbayar" style="border-top: 1px inset #fff"> 
          <?php 
          if($lgn=="1") {
          echo '
          <label class="control-label col-xs-6"><p align="left"><button id="cbkuota" style="background-color: #fff; color:#6C0" class="btn btn-xs" type="button" name="">Bayar Kuota</button></p></label>
          <label class="control-label col-xs-6"><p align="right"><a id="tbbayar" href="#pop-cara-bayar" style="background-color: #fff; color:#6C0" class="btn btn-xs" type="button" name="">Tambah Cara Bayar</a></p></label>
          ';
          }
          else {
          echo '
          <label class="control-label col-xs-12"><p align="right"><a id="tbbayar" href="#pop-cara-bayar" style="background-color: #fff; color:#6C0" class="btn btn-xs" type="button" name="">Tambah Cara Bayar</a></p></label>
          ';
          }
          ?>           
          
        </div>
      </div>

      <div class="form-group"> 
        <label class="control-label col-xs-6"><p align="left">Sisa</p></label>      
        <div class="col-xs-6">
          <input class="form-control" id="sisa" type="text" name="sisa" value="0" readonly="" data-a-dec="," data-a-sep="." style="font-weight: bolder" onfocus="startH()" onblur="endH()">
        </div>  
      </div>

      <input type="submit" class="btn btn-success col-xs-6" id="submitPembayaran" value="Simpan" disabled="true" style="background-color:#FFF; color:#6C0" onclick="test()">      
    </form>

    <a href="?id=<?php echo $_GET['id'];?>&selesai=ya" class="popup-link" id="batalbayar">
      <input type="button" class="btn btn-success col-xs-6" value="Batal" style="background-color:#FFF; color:#6C0"/>
    </a>
    <br><br>

  </div>
</div>


<div class="popup-wrapper" id="pop-cara-bayar">
  <div class="popup-container">
    <div class="row">
      <p>Customer Yth, Bayarnya mau menggunakan apa?</p>
    </div>  

    <div class="row">
      <a href="#pop-pembayaran" class="popup-link">
      <input type="button" class="btn btn-success col-xs-4" value="Cash" id="cash" style="background-color:#FFF; color:#6C0"/>
      </a>
      <a href="#pop-edc" class="popup-link">
      <input type="button" class="btn btn-success col-xs-4" value="Debet/Kredit" id="edc" style="background-color:#FFF; color:#6C0"/>
      </a>

      <?php 
      if($lgn=="1"){
      echo '
      <a href="#pop-pembayaran" class="popup-link">
      <input type="button" class="btn btn-success col-xs-4" value="Kuota" id="kuotaB" style="background-color:#FFF; color:#6C0"/>
      </a>
      ';
      }
      else {
      echo '
      <a href="#pop-cashback" class="popup-link">
      <input type="button" class="btn btn-success col-xs-4" value="Cashback" id="cashb" style="background-color:#FFF; color:#6C0"/>
      </a>
      ';
      }

      ?>

      
    </div>
      
    <div style="padding-bottom: 25px; padding-top: 15px"> 
      <a class="popup-close" href="#pop-tagihan"><img src="back.png" /></a> 
      <a class="popup-close hidden" href="#pop-pembayaran" id="lanjutb1" style="text-align: right; margin-right: -90%; display: relative"><img width="16%" src="Next-icon.png" /></a> 
    </div>
  </div>
</div>

<div class="popup-wrapper" id="pop-edc">
  <div class="popup-container">
    <div class="row">
      <p>Kartu Debet/Kredit ?</p>
    </div> 
    <div class="row">
      <a href="#pop-pembayaran" class="popup-link">
      <input type="button" class="btn btn-success col-xs-2" value="BNI" id="bni" style="background-color:#FFF; color:#6C0"/>
      </a>
      <a href="#pop-pembayaran" class="popup-link">
      <input type="button" class="btn btn-success col-xs-2" value="BRI" id="bri" style="background-color:#FFF; color:#6C0"/>
      </a>
      <a href="#pop-pembayaran" class="popup-link">
      <input type="button" class="btn btn-success col-xs-2" value="BCA" id="bca" style="background-color:#FFF; color:#6C0"/>
      </a>
      <a href="#pop-pembayaran" class="popup-link">
      <input type="button" class="btn btn-success col-xs-2" value="Mandiri" id="mandiri" style="background-color:#FFF; color:#6C0"/>
      </a>
      <a href="#pop-pembayaran" class="popup-link">
      <input type="button" class="btn btn-success col-xs-2" value="OVO" id="ovo" style="background-color:#FFF; color:#6C0"/>
      </a>
      <a href="#pop-pembayaran" class="popup-link">
      <input type="button" class="btn btn-success col-xs-2" value="Go-Pay" id="gopay" style="background-color:#FFF; color:#6C0"/>
      </a>
    </div>
      
    <div style="padding-bottom: 25px; padding-top: 15px"> 
      <a class="popup-close" href="#pop-cara-bayar"><img src="back.png" /></a>     
    </div>
  </div>
</div>

<div class="popup-wrapper" id="pop-cashback">
  <div class="popup-container">
    <div class="row">
      <p>Kode Voucher</p>
    </div> 
    <div class="row">
      <div style="margin: 2% auto; position: relative; padding: 20px 30px; background-color: #5ab400; color:#fff; border-radius: 3px;">        
        <div class="form-group" style="margin-bottom: 10%">
          <div class="col-xs-6">
             <input type="text" autocomplete="off" class="form-control" value="" id="kodevoucher" style="background-color:#FFF; color:#6C0" placeholder="Scan di sini..!" onfocus="startH()" onblur="endH()" /><span onfocus="startH()" onblur="endH()" id="pesanvoucher"></span>
          </div>
          <div class="col-xs-6">
             <input type="text" autocomplete="off" class="form-control" value="0" readonly="" id="nilaivoucher" style="background-color:#FFF; color:#6C0" onfocus="startH()" onblur="endH()"/>
          </div>        
        </div>
          
      </div>
        
    </div>
      
    <div style="padding-bottom: 25px; padding-top: 15px;"> 
      <a class="popup-close" href="#pop-cara-bayar"><img src="back.png" /></a>   
      <a class="popup-close" href="#pop-pembayaran" style="text-align: right; margin-right: -90%; display: relative"><img width="16%" src="Next-icon.png" /></a>      
    </div>
  </div>
</div>



<script type="text/javascript">

  function startH(){
    interval = setInterval("hit()",5);
  }

  function hit(){
    tagihan = $('#tagihan').val();
    cash = $('#nilaicash').val();
    cashb = $('#nilaicashb').val();
    bni = $('#nilaibni').val();
    bri = $('#nilaibri').val();
    bca = $('#nilaibca').val();
    mandiri = $('#nilaimandiri').val();
    ovo = $('#nilaiovo').val();
    gopay = $('#nilaigopay').val();
    kuota = $('#nilaikuota').val();

    kodevoucher = $("#kodevoucher").val();
    $('#kodevoucher2').val(kodevoucher);
    
    idc = "<?= $_GET['id'] ?>";

    if(kodevoucher!="") {

      $.ajax({
        url: 'voucher_cashback.php',        
        data: 'cashback='+kodevoucher+'&harga='+tagihan+'&idc='+idc,
      }).done(function(data){
        var json_data = data,
        obj = JSON.parse(json_data);
          $('#nilaivoucher, #nilaicashb').val(obj.diskon);
          if(obj.pesan>0) {
            $('#pesanvoucher').text("Klik bayar untuk melanjutkan!!").css('color', '#fff');
          }
          else {
            $('#pesanvoucher').text("kode tidak dapat digunakan!!").css('color', 'red');
          }
                               
      });
    } 

    kuotacks = $('#kuotacks').val();
    kuotackl = $('#kuotackl').val();
    kuotack = $('#kuotack').val();
    kuotass = $('#kuotass').val();
    kuotaP = $('#kuotaP').val();    
  
    hargakonversi = '<?= $hargakonversi ?>';
    hargakonversickl = '<?= $hargakonversickl ?>';
    hargakonversick = '<?= $hargakonversick ?>';
    hargakonversiss = '<?= $hargakonversiss?>';

    tkiloan = "<?= $kiloan ?>";
    tpotongan = "<?= $potongan ?>";

    skiloan = "<?= sisa_kiloan($idcs) ?>";
    spotongan = "<?= sisa_potongan($idcs) ?>";

    if(tkiloan>skiloan*hargakonversi){
      $('#kuotacks').attr('readonly', true).val(skiloan);
      $('#kuotackl,#kuotack,#kuotass').attr('readonly', true).val(0);
    }

    if(tpotongan>spotongan*1){
      $('#kuotaP').attr('readonly', true).val(spotongan);
    }

    if(tkiloan==0){
      $('#kuotackl,#kuotack,#kuotass').attr('readonly', true);
    }

    if(tpotongan==0){
      $('#kuotaP').attr('readonly', true);
    }

    nilaikuota = (kuotacks*hargakonversi+kuotackl*hargakonversickl+kuotack*hargakonversick+kuotass*hargakonversiss+kuotaP*1).toFixed();
    $('#nilaikuota').val(nilaikuota); 
      

    sisa = tagihan-cash-bni-bri-bca-mandiri-ovo-gopay-cashb-kuota;
    $('#sisa').val(sisa); 

    if(sisa==0){
      $('#submitPembayaran').removeAttr('disabled');
      $('#submitPembayaran').click(function(){
        $(this).css('display', 'none');
      });
    }else{
      $('#submitPembayaran').prop('disabled', true);
    }

  }

  function endH(){
    clearInterval(interval);
  }
   
  $('#cash').on('click', function(){
    $('#daricash, #lanjutb1').removeClass('hidden');
    $(this).css('background-color', '#5ab400').css('color', '#fff').prop('disabled', true);
  })
  $('#edc').on('click', function(){
    $(this).css('background-color', '#5ab400').css('color', '#fff').prop('disabled', true);
  })
  $('#cashb').on('click', function(){
    $('#daricashb, #lanjutb1').removeClass('hidden');
    $(this).css('background-color', '#5ab400').css('color', '#fff').prop('disabled', true);
  })
  $('#bni').on('click', function(){
    $('#daribni').removeClass('hidden');
    $(this).css('background-color', '#5ab400').css('color', '#fff');
  })
  $('#bca').on('click', function(){
    $('#daribca').removeClass('hidden');
    $(this).css('background-color', '#5ab400').css('color', '#fff');
  })
  $('#bri').on('click', function(){
    $('#daribri').removeClass('hidden');
    $(this).css('background-color', '#5ab400').css('color', '#fff');
  })
  $('#mandiri').on('click', function(){
    $('#darimandiri').removeClass('hidden');
    $(this).css('background-color', '#5ab400').css('color', '#fff');
  })
  $('#ovo').on('click', function(){
    $('#dariovo').removeClass('hidden');
    $(this).css('background-color', '#5ab400').css('color', '#fff');
  })
  $('#gopay').on('click', function(){
    $('#darigopay').removeClass('hidden');
    $(this).css('background-color', '#5ab400').css('color', '#fff');
  })
   $('#tbbayar').on('click', function(){
    $(this).addClass('hidden');
  });
  $('#cbkuota, #kuotaB').on('click', function(){
    $('#darikuota1, #darikuota2').removeClass('hidden');
    $('#cbkuota').addClass('hidden');
    $('#kuotaB').css('background-color', '#5ab400').css('color', '#fff').prop('disabled', true);
  });

      

</script>

<!-- end -->

<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

<script type="text/javascript">
function startHitung(){
interval=setInterval("Hitung()",10);
}

function Hitung(){
  var a=document.form3.total1.value;
  var b=document.form3.cash.value;
  var c=document.form3.diskon.value;
  var d=document.form3.nilaiedc.value;
  var e=document.form3.kuota.value;
  var f=document.form3.totalkuota.value;
  document.form3.sisakuota.value=(f-e);
  document.form3.sisa.value=(a-b-c-d-e);
  if (document.form3.sisakuota.value<=0){
    //alert("Kuota Tidak Mencukupi!!");
    document.form3.kuota.value=0;
    document.form3.sisakuota.value=(f-e);
    }
  if (document.form3.sisa.value==0){
    document.form3.simpan.disabled=false;
    }
  if (document.form3.sisa.value!=0){
    document.form3.simpan.disabled=true;
    }
}

function stopHitung(){
clearInterval(interval);
}

function edc(){
  document.form3.nilaiedc.readOnly = false;
}

function startHitunglgn(){
intervallgn=setInterval("Hitunglgn()",10);
}

function Hitunglgn() {
  var p=document.form4.totalk.value;
  var q=document.form4.totalp.value;
  var r=document.form4.totalkuotak.value;
  var s=document.form4.totalkuotap.value;
  var t=document.form4.kuotak.value;
  var u=document.form4.kuotap.value;
  var v=document.form4.cash.value;
  var w=document.form4.nilaiedc.value;
  document.form4.sisakuotak.value=(r-t);
  document.form4.sisakuotap.value=(s-u);
  document.form4.sisatk.value=(p-t);
  document.form4.sisatp.value=(q-u-v-w);
  if (document.form4.sisakuotak.value<0){
      alert("Kuota Tidak Mencukupi!!");
    document.form4.kuotak.value=0;
    document.form4.sisakuotak.value=(r-t);
    }
  if (document.form4.sisakuotap.value<0){
      alert("Kuota Tidak Mencukupi!!");
    document.form4.kuotap.value=0;
    document.form4.sisakuotap.value=(s-u);
    }
  if ((document.form4.sisatk.value==0) && (document.form4.sisatp.value==0)){
    document.form4.simpan.disabled=false;
    } 
  if ((document.form4.sisatk.value!=0) && (document.form4.sisatp.value!=0)){
    document.form4.simpan.disabled=true;    
    } 
}

function stopHitunglgn(){
clearInterval(intervallgn);
}

function edclgn(){
  document.form4.nilaiedc.readOnly = false;
}


</script>

    <div class="modal-dialog">

    <div class="modal-content">

    <?php
    include 'code.php';


    $langganan = mysqli_query($con, "select *from langganan where id_customer='$id' ");
    $ql = mysqli_fetch_array($langganan);

    $qtotpenjualan = mysqli_query($con, "select sum(total_bayar) as total from reception where id_customer='$id' and lunas='0' ");
    $rtotpenjualan = mysqli_fetch_array($qtotpenjualan);

    $qtotpenjualanp = mysqli_query($con, "select sum(total_bayar) as total from reception where id_customer='$id' and lunas='0' and jenis='p' ");
    $rtotpenjualanp = mysqli_fetch_array($qtotpenjualanp);

    $qtotpenjualank = mysqli_query($con, "select sum(total_bayar) as total from reception where id_customer='$id' and lunas='0' and jenis='k' ");
    $rtotpenjualank = mysqli_fetch_array($qtotpenjualank);

    // $citemk  = mysqli_query($con, "select sum(a.berat) as berat, a.id_customer as id, a.lunas as lunas from reception as a INNER JOIN detail_penjualan as b ON a.no_nota=b.no_nota where a.id_customer='$id' and a.lunas='0' and b.item like 'Cuci Kering Setrika%' ");
    // $qck = mysqli_fetch_assoc($citemk);
    // $citems  = mysqli_query($con, "select sum(a.berat) as berat, a.id_customer as id, a.lunas as lunas from reception as a INNER JOIN detail_penjualan as b ON a.no_nota=b.no_nota where a.id_customer='$id' and a.lunas='0' and b.item like 'Setrika%' ");
    // $qcs = mysqli_fetch_assoc($citems);

    $qtotretail = mysqli_query($con, "select sum(total) as total from detail_retail where id_customer='$id' and lunas='0'");
    $rtotretail = mysqli_fetch_array($qtotretail);

    //Langganan
    $tottagihanps = $rtotpenjualanp['total']+$rtotretail['total'];   
    $tottagihank = ($rtotpenjualank['total']/8800); 

    $tottaaaall = $rtotretail['total']+$rtotpenjualan['total'];

    if($r['lgn']==1){
      if($ql['kilo_cks']>=($rtotpenjualank['total']/8800)){
     ?>
<form name="form4" id="form4" action="act_penjualanlgn.php" method="GET" class="form-horizontal"><br>
<?php if (isset($_GET['faktur'])){ ?>
  <input type="hidden" name="no_faktur" id="id_faktur" value="<?php echo $_GET['faktur']; ?>" />  
<?php } else{?>
  <input type="hidden" name="no_faktur" id="id_faktur" value="<?php echo $nofaktur; ?>" />  
<?php	} ?>
<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
<h4  align="center"><strong>Formulir Pembayaran</strong></h4>
<table width="90%" align="center" style="margin:20px;">
 <tr>
  <td width="58%"><strong>Total Tagihan</strong></td>
  <td> : </td><td>
 <input type="text" value="<?php echo $tottagihank; ?>" id="totalk" name="totalk" class="form-control" style="width:100%" readonly="readonly">
 <input type="text" value="<?php echo $tottagihanps; ?>" id="totalp" name="totalp" class="form-control" style="width:100%" readonly="readonly">
 </td></tr>
 <tr>
  <td width="58%">Total Kuota Langganan</td>
  <td> : </td><td>
 <input type="text" value="<?php echo $ql['kilo_cks']; ?>" id="totalkuotak" name="totalkuotak" class="form-control hidden" style="width:50%" readonly="readonly">
 <input type="text" value="<?php echo $ql['kilo_cks']; ?>" id="sisakuotak" name="sisakuotak" class="form-control" style="width:50%" readonly="readonly">
 <input type="text" value="<?php echo $ql['potongan']; ?>" id="totalkuotap" name="totalkuotap" class="form-control hidden" style="width:50%" readonly="readonly">
 <input type="text" value="<?php echo $ql['potongan']; ?>" id="sisakuotap" name="sisakuotap" class="form-control" style="width:50%" readonly="readonly">
 </td></tr>
 <tr>
  <td width="58%">Pembayaran Dengan Kuota</td>
  <td width="3%"> : </td>
  <td width="39%" align="right">
   <input type="text" placeholder="0" value="0" id="kuotak" name="kuotak" class="form-control" style="width:100%" onfocus="startHitunglgn()" onblur="stopHitunglgn()">
   <input type="text" placeholder="0" value="0" id="kuotap" name="kuotap" class="form-control" style="width:100%" onfocus="startHitunglgn()" onblur="stopHitunglgn()">
  </td>
 </tr> 
 <tr>
  <td width="58%">Pembayaran Cash</td>
  <td width="3%"> : </td>
  <td width="39%" align="right">
   <input type="text" placeholder="0" value="0" id="cash" name="cash" class="form-control" style="width:100%" onfocus="startHitunglgn()" onblur="stopHitunglgn()">
  </td>
 </tr>
 <tr>
  <td>
    <select class="form-control" name="bankedc" id="bankedc" onchange="edclgn()">
     <option value="">Pilih Mesin EDC</option>
     <option value="BCA">BCA</option>
     <option value="Mandiri">Mandiri</option>
     <option value="BRI">BRI</option>
     <option value="BNI">BNI</option>
    </select>
  </td>
  <td> : </td>
  <td align="right">
   <input type="text" placeholder="0" id="nilaiedc" name="nilaiedc" class="form-control" style="width:100%" value="0" onfocus="startHitunglgn()" onblur="stopHitunglgn()" readonly="readonly">
  </td>
 </tr>
 <tr>
  <td width="58%"><strong>Sisa Tagihan</strong></td>
  <td> : </td><td>
  <input type="text" value="<?php echo str_replace("Rp."," ",rupiah($rtotpenjualan['berat'], true)); ?>" id="sisatk" name="sisatk" class="form-control" style="width:100%; font-weight: bold; font-size: 16px" readonly="readonly" >
  <input type="text" value="<?php echo str_replace("Rp."," ",rupiah($tottaaaall, true)); ?>" id="sisatp" name="sisatp" class="form-control" style="width:100%; font-weight: bold; font-size: 16px" readonly="readonly" >
 </td></tr>
 <tr><td colspan="3">&nbsp;</td></tr>
 <tr><td colspan="3" style="text-align:center;"><input type="submit" value="simpan" class="btn btn-lg btn-success pull-right" style="width:100%;" disabled="disabled" name="simpan" id="simpan"/></td></tr> 
</table>
<br />

        </form>

         <?php 
        }else{?>
            <script type="text/javascript">
            	alert("Kuota Kiloan Tidak Mencukupi!!");
            </script>
            <?php
        }
    }else{
    ?>

<form name="form3" id="form3" action="act_penjualan.php" method="GET" class="form-horizontal"><br>
<?php if (isset($_GET['faktur'])){ ?>
  <input type="hidden" name="no_faktur" id="id_faktur" value="<?php echo $_GET['faktur']; ?>" />  
<?php } else{?>
  <input type="hidden" name="no_faktur" id="id_faktur" value="<?php echo $nofaktur; ?>" />  
<?php	} 

$qtotpenjualan = mysqli_query($con, "select sum(total_bayar) as total from reception where id_customer='$id' and lunas='0'");
$rtotpenjualan = mysqli_fetch_array($qtotpenjualan);

$qtotretail = mysqli_query($con, "select sum(total) as total from detail_retail where id_customer='$id' and lunas='0'");
$rtotretail = mysqli_fetch_array($qtotretail);

$tottaaaall = $rtotretail['total']+$rtotpenjualan['total'];
?>
<input type="hidden" name="total" value="<?php echo $tottaaaall;?>" />
<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
<h4  align="center"><strong>Formulir Pembayaran</strong></h4>
<table width="90%" align="center" style="margin:20px;">
 <tr>
  <td width="58%"><strong>Total Tagihan</strong></td>
  <td> : </td>
  <td>
 <input type="text" value="<?php echo $tottaaaall; ?>" id="total1" name="total1" class="form-control" style="width:100%" readonly="readonly">
 </td></tr>
  <tr>
    <td width="58%">Voucher Cashback</td>
    <td> : </td>
    <td>
      <input type="text" placeholder="Masukkan kodenya disini!" id="vcashback" name="vcashback" class="form-control" style="width:100%" onkeyup="tampung()">
    </td>
 </tr>
 <tr>
    <td></td>
    <td></td>
    <td><textarea class="form-control" rows="2" readonly id="pesan" name="pesan" style="font-size: 12px"></textarea></td>
 </tr>
  <tr>
  <td width="58%"></td>
  <td width="3%"></td>
  <td width="39%" align="right">  
  <input type="text" id="diskon" name="diskon" class="form-control hidden" style="width:100%" onfocus="startHitung()" onblur="stopHitung()">
  </td>
 </tr>
	 <input type="hidden" value="0" id="totalkuota" name="totalkuota" class="form-control" style="width:50%" readonly="readonly">
	 <input type="hidden" value="0" id="sisakuota" name="sisakuota" class="form-control" style="width:50%" readonly="readonly">
	 <input type="hidden" placeholder="0" value="0" id="kuota" name="kuota" class="form-control" style="width:100%" onfocus="startHitung()" onblur="stopHitung()">

 <tr>
  <td width="58%">Pembayaran Cash</td>
  <td width="3%"> : </td>
  <td width="39%" align="right">
   <input type="text" placeholder="0" value="0" id="cash" name="cash" class="form-control" style="width:100%" onfocus="startHitung()" onblur="stopHitung()">
  </td>
 </tr>
 <tr>
  <td>
    <select class="form-control" name="bankedc" id="bankedc" onchange="edc()">
     <option value="">Pilih Mesin EDC</option>
     <option value="BCA">BCA</option>
     <option value="Mandiri">Mandiri</option>
     <option value="BRI">BRI</option>
     <option value="BNI">BNI</option>
    </select>
  </td>
  <td> : </td>
  <td align="right">
   <input type="text" placeholder="0" id="nilaiedc" name="nilaiedc" class="form-control" style="width:100%" value="0" onfocus="startHitung()" onblur="stopHitung()" readonly="readonly">
  </td>
 </tr>
 <tr>
  <td width="58%"><strong>Sisa Tagihan</strong></td>
  <td> : </td><td>
 <input type="text" value="<?php echo str_replace("Rp."," ",rupiah($tottaaaall, true)); ?>" id="sisa" name="sisa" class="form-control" style="width:100%; font-weight: bold; font-size: 16px" readonly="readonly" >
 </td></tr>
 <tr><td colspan="3">&nbsp;</td></tr>
 <tr><td colspan="3" style="text-align:center;"><input type="submit" value="simpan" class="btn btn-lg btn-success pull-right" style="width:100%;" disabled="disabled" name="simpan" id="simpan"/></td></tr> 
</table>
<br />

        </form>
        <?php 
        } ?>
      </div>
    </div>
  </div>

    <script type="text/javascript">     
      function tampung(){       
      var cashback = $("#vcashback").val();
      var harga = $("#total1").val();
      var faktur = $("#id_faktur").val();
      var idc = $("#id_cs").val();
      $.ajax({
        url: 'voucher_cashback.php',        
        data: 'cashback='+cashback+'&harga='+harga+'&faktur='+faktur+'&idc='+idc,
      }).done(function(data){
        var json_data = data,
        obj = JSON.parse(json_data);
        $('#diskon').val(obj.diskon);
        $('#pesan').val(obj.pesan);    
                       
        });
      };
    </script>