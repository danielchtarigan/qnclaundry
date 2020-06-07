<?php 
include 'code.php';
$idcs = $id;
$lgn = ($r['lgn']=="1") ? "1" : "0";

$qdelivery = mysqli_query($con,"SELECT no_telp,alamat,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan,waktu_permintaan,catatan FROM delivery WHERE id_customer='$_GET[id]' AND no_faktur IS NULL AND jenis_permintaan='Antar' ORDER BY tgl_input DESC LIMIT 1");
if (mysqli_num_rows($qdelivery)>0) {
  $delivery = mysqli_fetch_array($qdelivery);
} else $delivery=null;

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


<div class="popup-wrapper" id="deliveryorder">
	<div class="popup-container">
		<label class="control-label col-xs-12">
			Butuh Delivery?
		</label>
			<input type="button" class="btn btn-success" value="Diantar" style="width:32%; background-color:#FFF; color:#6C0" onclick="deliveryform()" id ="tombol-delivery">
			<a href="act/delete_delivery.php?id=<?php echo $id ?>" class="popup-link">
			<input type="button" class="btn btn-success btpotongan" value="Ambil Sendiri" style="width:32%; background-color:#FFF; color:#6C0"/>
			</a>
			<form method="GET" action="act/act_delivery.php" id="form-delivery" style="display:none; font-size: 11px">
				<hr>
					<input type="hidden" name="id_customer" value="<?php echo $id; ?>">
					<input type="hidden" name="nama_customer" value="<?php echo $rcustomer1['nama_customer'] ?>">
          <div class="form-group">
						<label class="control-label col-xs-12" for="no_telp_antar">
								No. Telepon (CP Pengantaran)
						</label>
						<input class="form-control" type="text" name="no_telp_antar" value="<?= $delivery!=null ? $delivery['no_telp'] : $r['no_telp'] ?>" required/>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="alamat_antar">
								Alamat Pengantaran (isi dengan alamat lengkap)
						</label>
						<textarea class="form-control" rows="2" name="alamat_antar" required><?= $delivery!=null ? $delivery['alamat'] : $r['alamat'] ?></textarea>
          </div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="tanggal_antar">
								Tanggal Pengantaran
						</label>
						<input type="text" autocomplete="off" class="form-control" name="tanggal_antar" id="tglantar" value="<?php if ($delivery!=null) echo $delivery['tgl_permintaan']; else if ($express) echo date('d/m/Y', strtotime('+1 day')); else echo date('d/m/Y', strtotime('+3 days')); ?>" required/>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="waktu_antar">Waktu Pengantaran</label>
							<select class="form-control" name="waktu_antar">
								<?php if ($delivery!=null) $waktu = $delivery['waktu_permintaan']; else $waktu=null?>
								<option value="Bebas" <?=$waktu == null||"Bebas" ? 'selected="selected"' : '';?>>Bebas</option>
								<option value="Pagi" <?=$waktu == "Pagi" ? 'selected="selected"' : '';?>>Pagi (09.00 - 12.00)</option>
								<option value="Siang" <?=$waktu == "Siang" ? 'selected="selected"' : '';?>>Siang (12.00 - 15.00)</option>
								<option value="Sore" <?=$waktu == "Sore" ? 'selected="selected"' : '';?>>Sore (15.00 - 18.00)</option>
								<option value="Malam" <?=$waktu == "Malam" ? 'selected="selected"' : '';?>>Malam (18.00 - 21.00)</option>
							</select>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="catatan">
								Catatan Pengantaran (Opsional)
						</label>
						<textarea class="form-control" rows="3" name="catatan"><?= $delivery!=null ? $delivery['catatan'] : '' ?></textarea>
          </div>
          <input type="submit" class="btn btn-success" value="Lanjut" style="width:49%; background-color:#FFF; color:#6C0;"/>
			</form><br />
			<a class="popup-close" href="#" onclick="closedeliverypopup()"><img src="back.png" />
			</a><br/>
    </div>
</div>


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
    <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
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


<!-- Script -->
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