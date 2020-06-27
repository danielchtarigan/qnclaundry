<?php 
date_default_timezone_set('Asia/Makassar');
$qcus = $con->query("SELECT * FROM customer WHERE id='$_GET[id]'");
$cus = $qcus->fetch_array();

$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : "";

$nota = '<input type="checkbox" class="" name="notamanual" id="notamanual" value="1" onclick="return nota_manual()"> <label class="labelnotamanual" style="vertical-align: top;" >Nota Manual</label><br><input class="form-control" type="text" name="notain" autocomplete="off" placeholder="Nomor Nota" readonly="" id="notain" value="">';


?>
<input class="form-control" type="text" name="notainput" style="display:none" autocomplete="off" readonly="" id="notainput" value="23">
<div class="popup-wrapper" id="layanan">
  <div class="popup-container">
    <div class="row">
      <a href="index.php?id=<?= $_GET['id'] ?>" class="timesx"><i class="fa fa-times"></i></a>
      <label class="control-label" style="font-size: 18px"><?= $_GET['jenis'] ?></label>
    </div> 
    <div class="row">
      <a href="#cucikeringsetrika" class="popup-link">
      <input type="button" class="btn btn-success col-xs-4" data-id="cucikeringsetrika" value="Cuci Kering Setrika" id="kiloan1" style="background-color:#FFF; color:#6C0;"/ onclick="kiloan(1)">
      </a>
      <a href="#cucikeringlipat" class="popup-link">
      <input type="button" class="btn btn-success col-xs-4" data-id="cucikeringlipat" value="Cuci Kering Lipat" id="kiloan2" style="background-color:#FFF; color:#6C0"/ onclick="kiloan(2)">
      </a>
      <!--<a href="#cucikering" class="popup-link">
      <input type="button" class="btn btn-success col-xs-3" data-id="cucikering" value="Cuci Kering" id="kiloan3" style="background-color:#FFF; color:#6C0"/ onclick="kiloan(3)">
      </a>-->
      <a href="#setrika" class="popup-link">
      <input type="button" class="btn btn-success col-xs-4" data-id="setrika" value="Setrika" id="kiloan4" style="background-color:#FFF; color:#6C0"/ onclick="kiloan(4)">
      </a>
    </div>  
  </div>
</div>

<!-- Potongan -->
<div class="popup-wrapper" id="potongan" style="top: 15px">
  <div class="popup-container">
    <div>
      <label class="control-label" style="font-size: 18px">Potongan</label>
    </div> 
    <div>
      <form class="form-horizontal" id="fpotongan">
        <?= $nota ?><br>
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Pilih Item</label>
          </div>
          <div class="col-xs-9">
            <select class="form-control" onchange="itemharga_potongan()" id="itemhargapotongan">
              <option value="0">--Pilih Item--</option>
              <?php 
              $level = 'harga_'.$levelharga;
              $sql = $con->query("SELECT kategori FROM item_harga WHERE kategori LIKE 'p%' GROUP BY kategori ORDER BY kategori ASC");
              while($data = $sql->fetch_array()){                
                  switch ($data['kategori']) {
                    case 'p1':
                      $kat = "Clothes";
                      break;
                    case 'p2':
                      $kat = "Shoes & Ransel";
                      break;
                    case 'p3':
                      $kat = "Beddings";
                      break;
                    case 'p4':
                      $kat = "Carpet";
                      break;
                    case 'p5':
                      $kat = "Gordyn";
                      break;
                  }
                  echo '<option value="0" disabled>'.$kat.'</option>';
                  $qp = $con->query("SELECT nama_item,$level AS harga FROM item_harga WHERE kategori='$data[kategori]' ORDER BY nama_item ASC");
                  while($datp = $qp->fetch_array()){
                    $item = $datp['nama_item'];
                    $harga = $datp['harga'];
                    if($r['lgn']==1){ 
                      $harga = $harga*0.88;
                    }
                    elseif($r['member']==1){
                      $harga = $datp['harga']*0.80;
                    }                    
                    echo '<option value="'.$item.'-'.$harga.'-'.$data['kategori'].'-'.$level.'"> &nbsp; &nbsp; '.$item.'</option>'; 
                  }
                               
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label"></label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="" id="itemkategori" readonly="">
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label"></label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="" id="itemlevel" readonly="">
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="" id="itempotongan" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Harga</label>
          </div>
          <div class="col-xs-3">
            <input class="form-control" type="text" name="" id="hargapotongan"> <!--readonly=""-->
          </div>
          <div class="col-xs-3" style="text-align: right;">
            <label class="control-label">Jumlah</label>
          </div>
          <div class="col-xs-3">
            <input class="form-control" type="number" value="0" name="" min="1" id="jumlahitem">
          </div>
        </div>    
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Ket Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="keteranganpotongan" placeholder="(Jika diperlukan)">
          </div>
        </div>      
        <div class="form-group">
          <div class="col-xs-12">
            <a href="javascript:" class="popup-link">
            <input type="button" class="btn btn-success btkiloan" value="Tambah" style="width: 100%; background-color:#FFF; color:#6C0" name="" onclick="tambah_potongan()"/>
            </a>
          </div>           
        </div> 
        <div class="form-group">
          <div class="col-xs-12" id="rincian_potongan"></div>
        </div>      
        <div class="form-group" style="margin-top: -5px">
          <div class="col-xs-6">
            <a href="javascript:" class="popup-link" id="nextpotongan">
            <input type="button" class="btn btn-success btkiloan" value="Next" style="width: 100%; background-color:#FFF; color:#6C0" name="simpanpotongan" />
            </a>
          </div>
          <div class="col-xs-6">
            <input type="button" class="btn btn-success btpotongan" value="Batal" style="width: 100%; background-color:#FFF; color:#6C0"/ onclick="batal_order()">
          </div>           
        </div>          
      </form>
    </div>      
    <div style="padding-bottom: 25px;"> 
      <a class="popup-close" href="javascript:" onclick="return backlayanan()"><img src="back.png" /></a>     
    </div>
  </div>
</div>

<!-- CuciKeringSetrika -->
<div class="popup-wrapper" id="cucikeringsetrika">
  <div class="popup-container">
    <div>
      <label class="control-label" style="font-size: 18px">Cuci Kering Setrika</label>
    </div> 
    <div>
      <form class="form-horizontal" id="fcucikeringsetrika">
        <?= $nota ?><br>
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Pilih Item</label>
          </div>
          <div class="col-xs-9">
            <select class="form-control" onchange="itemharga_cks()" id="itemhargacks">
              <option value="0">--Pilih Item--</option>
              <?php 
              $level = 'harga_'.$levelharga;
              $sql = $con->query("SELECT nama_item,berat,$level AS harga FROM item_harga WHERE kategori='k1'");
              
              while($data = $sql->fetch_array()){
                  $setrika = mysqli_fetch_array(mysqli_query($con, "SELECT $level AS harga FROM item_harga WHERE kategori='k2' "))[0];
                  $berat = number_format($data['berat'],1,',','.');
                  $harga = $data['harga']+$setrika*$data['berat'];
                  $item = 'Cuci Kering Setrika '.$berat.' Kg';
                  if($r['lgn']==1){
                    $harga = round($data['berat']*round($hargakonversi));
                  }
                  elseif($r['member']==1){
                    $harga = $harga*0.80;
                  }
                  elseif($r['type_c']==1){
                    $harga = round($data['berat']*7600);
                  }
                  echo '
                  <option value="'.$item.'-'.$harga.'-'.$data['berat'].'">'.$item.'</option>
                  ';              
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="itemcks" id="itemcks" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Harga</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="hargacks" id="hargacks" readonly="">
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Berat</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="beratcks" id="beratcks" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Ket Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="keterangan" placeholder="(Jika diperlukan)">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-6">
            <a href="javascript:" class="popup-link" id="nextcks">
            <input type="button" class="btn btn-success btkiloan" value="Next" style="width: 100%; background-color:#FFF; color:#6C0" name="simpancks" onclick="simpan_cks()"/>
            </a>
          </div>
          <div class="col-xs-6">
            <input type="button" class="btn btn-success btpotongan" value="Batal" style="width: 100%; background-color:#FFF; color:#6C0"/ onclick="batal_order()">
          </div>           
        </div>          
      </form>
    </div>      
    <div style="padding-bottom: 25px; padding-top: 5px"> 
      <a class="popup-close" href="javascript:" onclick="return backlayanan()"><img src="back.png" /></a>     
    </div>
  </div>
</div>

<!-- CuciKeringLipat -->
<div class="popup-wrapper" id="cucikeringlipat">
  <div class="popup-container">
    <div>
      <label class="control-label" style="font-size: 18px">Cuci Kering Lipat</label>
    </div> 
    <div>
      <form class="form-horizontal" id="fcucikeringlipat">
        <?= $nota ?><br>
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Pilih Item</label>
          </div>
          <div class="col-xs-9">
            <select class="form-control" onchange="itemharga_ckl()" id="itemhargackl">
              <option value="0">--Pilih Item--</option>
              <?php 
              $level = 'harga_'.$levelharga;
              $sql = $con->query("SELECT nama_item,berat,$level AS harga FROM item_harga WHERE kategori='k1'");
              while($data = $sql->fetch_array()){
                  $lipat = mysqli_fetch_array(mysqli_query($con, "SELECT $level AS harga FROM item_harga WHERE kategori='k3' "))[0];
                  $berat = number_format($data['berat'],1,',','.');
                  $harga = $data['harga']+$lipat*$data['berat'];
                  $item = 'Cuci Kering Lipat '.$berat.' Kg';
                  if($r['lgn']==1){
                    $harga = round($data['berat']*round($hargakonversi*0.6));
                  }
                  elseif($r['member']==1){
                    $harga = $harga*0.80;
                  }
                  echo '
                  <option value="'.$item.'-'.$harga.'-'.$data['berat'].'">'.$item.'</option>
                  ';              
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="itemckl" id="itemckl" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Harga</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="hargackl" id="hargackl" readonly="">
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Berat</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="beratckl" id="beratckl" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Ket Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="keteranganckl" placeholder="(Jika diperlukan)">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-6">
            <a href="javascript:" class="popup-link" id="nextckl">
            <input type="button" class="btn btn-success btkiloan" value="Next" style="width: 100%; background-color:#FFF; color:#6C0" name="simpanckl" onclick="simpan_ckl()"/>
            </a>
          </div>
          <div class="col-xs-6">
            <input type="button" class="btn btn-success btpotongan" value="Batal" style="width: 100%; background-color:#FFF; color:#6C0"/ onclick="batal_order()">
          </div>           
        </div>          
      </form>
    </div>      
    <div style="padding-bottom: 25px; padding-top: 5px"> 
      <a class="popup-close" href="javascript:" onclick="return backlayanan()"><img src="back.png" /></a>    
    </div>
  </div>
</div>

<!-- Setrika -->
<div class="popup-wrapper" id="setrika">
  <div class="popup-container">
    <div>
      <label class="control-label" style="font-size: 18px">Setrika</label>
    </div> 
    <div>
      <form class="form-horizontal" id="fsetrika">
        <?= $nota ?><br>
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Pilih Item</label>
          </div>
          <div class="col-xs-9">
            <select class="form-control" onchange="itemharga_ss()" id="itemhargass">
              <option value="0">--Pilih Item--</option>
              <?php 
              $level = 'harga_'.$levelharga;
              $sql = $con->query("SELECT berat,$level AS harga FROM item_harga WHERE kategori='k1'");
              while($data = $sql->fetch_array()){
                  $setrika = mysqli_fetch_array(mysqli_query($con, "SELECT $level AS harga FROM item_harga WHERE kategori='k2' "))[0];
                  $berat = number_format($data['berat'],1,',','.');
                  $harga = $setrika*$data['berat'];
                  $item = 'Setrika '.$berat.' Kg';
                  if($r['lgn']==1){
                    $harga = round($data['berat']*round($hargakonversi*0.7));
                  }
                  elseif($r['member']==1){
                    $harga = $harga*0.80;
                  }
                  echo '
                  <option value="'.$item.'-'.$harga.'-'.$data['berat'].'">'.$item.'</option>
                  ';              
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="itemss" id="itemss" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Harga</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="hargass" id="hargass" readonly="">
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Berat</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="beratss" id="beratss" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Ket Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="keteranganss" placeholder="(Jika diperlukan)">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-6">
            <a href="javascript:" class="popup-link" id="nextck">
            <input type="button" class="btn btn-success btkiloan" value="Next" style="width: 100%; background-color:#FFF; color:#6C0" name="simpanckl" onclick="simpan_ss()"/>
            </a>
          </div>
          <div class="col-xs-6">
            <input type="button" class="btn btn-success btpotongan" value="Batal" style="width: 100%; background-color:#FFF; color:#6C0"/ onclick="batal_order()">
          </div>           
        </div>          
      </form>
    </div>      
    <div style="padding-bottom: 25px; padding-top: 5px"> 
      <a class="popup-close" href="javascript:" onclick="return backlayanan()"><img src="back.png" /></a>  
    </div>
  </div>
</div>

<!-- CuciKering -->
<div class="popup-wrapper" id="cucikering">
  <div class="popup-container">
    <div>
      <label class="control-label" style="font-size: 18px">Cuci Kering</label>
    </div> 
    <div>
      <form class="form-horizontal" id="fcucikering">
        <?= $nota ?><br>
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Pilih Item</label>
          </div>
          <div class="col-xs-9">
            <select class="form-control" onchange="itemharga_ck()" id="itemhargack">
              <option value="0">--Pilih Item--</option>
              <?php 
              $level = 'harga_'.$levelharga;
              $sql = $con->query("SELECT nama_item,berat,$level AS harga FROM item_harga WHERE kategori='k1'");
              while($data = $sql->fetch_array()){
                  $berat = number_format($data['berat'],1,',','.');
                  $harga = $data['harga'];
                  $item = 'Cuci Kering '.$berat.' Kg';
                  if($r['lgn']==1){
                    $harga = round($data['berat']*round($hargakonversi*0.3));
                  }
                  elseif($r['member']==1){
                    $harga*0.80;
                  }
                  echo '
                  <option value="'.$item.'-'.$harga.'-'.$data['berat'].'">'.$item.'</option>
                  ';              
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="itemck" id="itemck" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Harga</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="hargack" id="hargack" readonly="">
          </div>
        </div>
        <div class="form-group hidden">
          <div class="col-xs-3">
            <label class="control-label">Berat</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="beratck" id="beratck" readonly="">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-3">
            <label class="control-label">Ket Item</label>
          </div>
          <div class="col-xs-9">
            <input class="form-control" type="text" name="keteranganck" placeholder="(Jika diperlukan)">
          </div>
        </div>        
        <div class="form-group">
          <div class="col-xs-6">
            <a href="javascript:" class="popup-link" id="nextck">
            <input type="button" class="btn btn-success btkiloan" value="Next" style="width: 100%; background-color:#FFF; color:#6C0" name="simpanckl" onclick="simpan_ck()"/>
            </a>
          </div>
          <div class="col-xs-6">
            <input type="button" class="btn btn-success btpotongan" value="Batal" style="width: 100%; background-color:#FFF; color:#6C0"/ onclick="batal_order()">
          </div>           
        </div>          
      </form>
    </div>      
    <div style="padding-bottom: 25px; padding-top: 5px"> 
      <a class="popup-close" href="javascript:" onclick="return backlayanan()"><img src="back.png" /></a>   
    </div>
  </div>
</div>


<!-- pilihanparfum -->
<div class="popup-wrapper" id="pilihanparfum">
  <div class="popup-container">
    <div class="row">
      <label class="control-label" style="font-size: 18px">Pilihan Parfum</label>
    </div> 
    <div class="row">
      <input type="button" class="btn btn-success btkiloan col-xs-4" value="Normal" id="pil_parfum1" style="background-color:#FFF; color:#6C0" onclick="simpan_parfum(1)" />
      <input type="button" class="btn btn-success btkiloan col-xs-4" value="Extra" id="pil_parfum2" style="background-color:#FFF; color:#6C0" onclick="simpan_parfum(2)" />
      <input type="button" class="btn btn-success btkiloan col-xs-4" value="Tanpa Parfum" id="pil_parfum3" style="background-color:#FFF; color:#6C0" onclick="simpan_parfum(3)" />
    </div>      
    <div style="padding-bottom: 25px; padding-top: 5px" id="parfumback"> 
      <!-- <a class="popup-close" href="#"><img src="back.png" /></a> -->     
    </div>
  </div>
</div>

<!-- Pilihan Hanger -->
<div class="popup-wrapper" id="pilihanhanger">
  <div class="popup-container">
    <div>
      <label class="control-label" style="font-size: 18px">Pilihan Hanger Dan Extra Service</label>
    </div> 
    <div>
      <form class="form-horizontal">       
        <div class="form-group">
          <div class="col-xs-12">
            <input class="" type="checkbox" name="hangersendiri" value="on"><label class="" style="vertical-align: top"> &nbsp; &nbsp; Hanger Sendiri</label>
            <label>Hanger yang dibawa sendiri hanya mendapatkan satu plastik hanger per nota. Beli plastik hanger jika membutuhkan plastik tambahan
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-3 col-xs-offset-1">
            <label class="control-label">Hanger</label>
          </div>
          <div class="col-xs-4">
            <input class="form-control" type="text" name="beli_hanger" id="beli_hanger" placeholder="0" onfocus="fhanger()">
          </div>
          <div class="col-xs-4">
            <label class="control-label">@ Rp. 2500</label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-3 col-xs-offset-1">
            <label class="control-label">Plastik Hanger</label>
          </div>
          <div class="col-xs-4">
            <input class="form-control" type="text" name="beli_plastikhanger" id="beli_plastikhanger" placeholder="0" onfocus="fhanger()">
          </div>
          <div class="col-xs-4">
            <label class="control-label">@ Rp. 2000</label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-3 col-xs-offset-1">
            <label class="control-label">Jumlah</label>
          </div>
          <div class="col-xs-4">
            <input class="form-control" type="text" name="" readonly="" value="0" id="chargehanger">
          </div>          
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <a href="javascript:" class="popup-link">
            <input type="button" class="btn btn-success btkiloan" value="Simpan dan Lanjut" style="width: 100%; background-color:#FFF; color:#6C0" onclick="simpan_hanger()"/>
            </a>
          </div> 
        </div>       
      </form>
    </div>      
    <div style="padding-bottom: 25px"> 
      <a class="popup-close" href="#pilihanparfum"><img src="back.png" /></a>     
    </div>
  </div>
</div>

<!-- PilihanExpress -->
<div class="popup-wrapper" id="pilihanexpress">
  <div class="popup-container">
    <div class="row">
      <label class="control-label" style="font-size: 18px">Pilihan Express</label>
    </div> 
    <div class="row">      
      <input type="button" class="btn btn-success btkiloan col-xs-3" value="Normal" id="pil_express0" style="background-color:#FFF; color:#6C0" onclick="simpan_express(0)" />
      <input type="button" class="btn btn-success btkiloan col-xs-3" value="Express" id="pil_express1" style="background-color:#FFF; color:#6C0" onclick="simpan_express(1)" />
      <input type="button" class="btn btn-success btkiloan col-xs-3" value="Double Express" id="pil_express2" style="background-color:#FFF; color:#6C0" onclick="simpan_express(2)" /> 
      <input type="button" class="btn btn-success btkiloan col-xs-3" value="Super Express" id="pil_express3" style="background-color:#FFF; color:#6C0" onclick="simpan_express(3)" />     
    </div>     
    <div style="padding-bottom: 25px; padding-top: 5px"> 
      <a class="popup-close" href="#pilihanhanger"><img src="back.png" /></a>     
    </div>
  </div>
</div>


<!-- PilihanVoucher -->
<div class="popup-wrapper" id="pilihanvoucher">
  <div class="popup-container">
    <div class="">
      <label class="control-label" style="font-size: 18px">Kode Voucher (jIka ada)</label>
    </div> 
    <form class="" id="fvoucher">
      <div class="form-group">
        <div class="row">
          <div class="col-xs-9">
            <input class="form-control" type="text" name="" id="kodevoucher"><span class="text-warning info" style="background: #c4dc96; font-style: italic;"></span>
          </div>
          <div class="col-xs-3">
            <input class="btn btn-success col-xs-12" style="background-color: #68d813" type="button" name="" onclick="return kode_voucher()" value="Gunakan">
          </div>  
        </div>                
      </div>     
      <div class="form-group">
        <input type="button" class="btn btn-success btkiloan col-xs-6" value="Selesai & Tampilkan" onclick="tampilkan_order()" style="background-color:#FFF; color:#6C0"/>
        <input type="button" class="btn btn-success btkiloan col-xs-6" value="Batal" style="background-color:#FFF; color:#6C0"/ onclick="batal_order()">
      </div>           
    </form>     
    <div style="padding-bottom: 25px; padding-top: 45px"> 
      <a class="popup-close" href="#pilihanexpress"><img src="back.png" /></a>     
    </div>  
  </div>
</div>


<div class="popup-wrapper" id="tampilanrincian">
  <div class="popup-container">

<?php
if (isset($_GET['nota'])){
?>
<label class="control-label col-xs-3" for="jumlahitem">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
</label>
<div class="col-xs-9" >
</div>
<?php
}

$qcustomer = mysqli_query($con, "select * from customer where id='$_GET[id]'");
$rcustomer = mysqli_fetch_array($qcustomer);
$nama_customer = $rcustomer['nama_customer'];
$qtmp = mysqli_query($con, "SELECT * from order_tmp where id_customer='$_GET[id]' AND cabang<>'Delivery'");
$ntmp = mysqli_num_rows($qtmp);
if($ntmp<1){
  $qtmp = mysqli_query($con, "SELECT * from order_potongan_tmp where id_customer='$_GET[id]' AND cabang<>'Delivery'");
}
$rtmp = mysqli_fetch_array($qtmp);
$no_nota = $rtmp['no_nota'];
?>
        <table style="width:100%; color: #fff">
           <tr>
              <?php
                  echo '<td>Nama</td> <td>:</td> <td>'.$nama_customer.'</td>
          <td rowspan=2 align=right>
          </td>
          </tr>';
                  echo '<tr><td>No Order</td> <td>:</td> <td>'.$no_nota.'</td>';
              ?>
           </tr>
        </table>
<?php
   $qview = mysqli_query($con, "select * from reception where id_customer='$id' and lunas='0' and no_nota='$no_nota'");
   $nview = mysqli_num_rows($qview);
    if ($nview > 0){
     $to = 0;
     $no = 1;
     echo "<table width='100%'>";
      while ($rview = mysqli_fetch_array($qview)){
        ?>
    <table style="font-size:9pt;border-top: 1px dotted #000;width:100%; color: #fff">
      <?php

      $diskon = 0;
      $sdiskon=mysqli_query($con,"SELECT sum(total) as totaldisk FROM detail_penjualan WHERE no_nota='$no_nota' and item like '%Voucher%'");
      $rdiskon = mysqli_fetch_array($sdiskon);
      $diskon = $rdiskon['totaldisk'];

        $totalall = 0; 
        $sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota='$no_nota' and item not like '%Voucher%' and item not like '%Express%'");
        while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
              <tr>
                                <td><?php echo $data2['jumlah'];?></td>
                                <td colspan="2"><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                                <td><a href="batal_transaksi.php?no_nota=<?php echo $no_nota; ?>&id=<?php echo $data2['item']; ?>"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
      <?php
      $total =  $data2['total'];
      $totalall = $totalall+$total;
      }

      

      $sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota='$no_nota' AND item LIKE '%Express%' AND item LIKE '%Express%' ");
      $totalexpress = 0;
      while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="#popup8" style="color: #fff"><?php echo ucwords($data2['item']);?></a></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                                <td><a href="batal_transaksi.php?no_nota=<?php echo $no_nota; ?>&id=<?php echo $data2['item']; ?>" style="color: #fff"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
<?php
      $totalexpress = $totalexpress+$data2['total'];
      }
      $sql2=mysqli_query($con,"SELECT * FROM rincian_pilihan_order WHERE no_nota='$no_nota'");
      $data2 = mysqli_fetch_array($sql2);
      if ($data2['parfum']=='extra'){
                            ?>
              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="#popup5" style="color: #fff">Ekstra Parfum</a></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=p"><button type="button" class="btn btn-warning btn-circle" style="color: #fff"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
      <?php   }
      if ($data2['parfum']=='no'){
                            ?>
              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="#popup5" style="color: #fff">Tanpa Parfum</a></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=p"><button type="button" class="btn btn-warning btn-circle" style="color: #fff"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
      <?php   }
      if ($data2['parfum']=='0'){
                            ?>
              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="#popup4" style="color: #fff">Parfum Normal</a></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=p"><button type="button" class="btn btn-warning btn-circle" style="color: #fff"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
      <?php   }
      if ($data2['hanger_own']=='on'){
                            ?>
              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="#popup5" style="color: #fff">Hanger Own</a></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=ho"><button type="button" class="btn btn-warning btn-circle" style="color: #fff"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
      <?php   }
      if ($data2['hanger']>0){
                            ?>
              <tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger']; ?></td>
                                <td><a href="#popup5" style="color: #fff">Hanger</a></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger']*2500,0,',','.');
                $totalall = $totalall+($data2['hanger']*2500);
                ?>
                                </td>
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=h"><button type="button" class="btn btn-warning btn-circle" style="color: #fff"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
      <?php   }
      if ($data2['hanger_plastik']>0){
                            ?>
              <tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger_plastik']; ?></td>
                                <td><a href="#popup5" style="color: #fff">Hanger Plastik</a></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger_plastik']*2000,0,',','.');
                $totalall = $totalall+($data2['hanger_plastik']*2000);
                ?>
                                </td>
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=hp"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>
      <?php   }


        $sql2=mysqli_query($con,"SELECT * FROM detail_penjualan  WHERE no_nota='$no_nota' and item like '%Voucher%'");
        $data2 = mysqli_fetch_array($sql2);
                            ?>
                        <tr style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
                              <td></td>
                                <td></td>
                                <td>Diskon</td>
        <td>Rp.</td>
                <td style="text-align:right;">
        <?php
echo str_replace('Rp.','',rupiah($diskon, true));
        ?>        </td>
                                <td><a href="batal_transaksi.php?no_nota=<?php echo $no_nota; ?>&id=<?php echo $data2['item']; ?>"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>

      </tr>
           

          <tr>
                                <td>&nbsp;</td>
                                <td style="width:50px;"></td>
        <td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
        <?php
        $totalall = $totalall+$totalexpress-$diskon;
        if ($totalall<0){
        $totalall = 0;
        }
        $uptotal = mysqli_query($con, "update reception set total_bayar='$totalall', diskon='$diskon' where no_nota='$no_nota'");

        //Start Setting voucher_cashback_order

        if(($totalall>=25000 && $totalall<50000) && $diskon==0){

          mysqli_query($con, "UPDATE voucher_cashback_order SET harga_nota='$totalall',nominal='10000' WHERE no_nota='$no_nota'");

        } else if($totalall>=50000 && $diskon==0){

          mysqli_query($con, "UPDATE voucher_cashback_order SET harga_nota='$totalall',nominal='25000' WHERE no_nota='$no_nota'");

        } else {

          mysqli_query($con, "DELETE FROM voucher_cashback_order WHERE no_nota='$no_nota'");
        }

        //End Setting voucher_cashback_order
        

echo str_replace('Rp.','',rupiah($totalall, true));
        ?>        </td>
                                <td></td>
      </tr>
<?php
    echo "</table>";
    }
     }
     $struk = "newstruk.php";
    ?>
                                        <a href="index.php?id=<?php echo $_GET['id'];?>" onclick="window.open('<?= $struk; ?>?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $no_nota; ?>')">
                                        <input type="button" class="btn btn-success btpotongan" value="Simpan" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $no_nota; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>


<br />
    </div>
</div>
</div>


<!-- Javascript -->
<script type="text/javascript">

   function nota_manual(){
      notamanual = $('#notamanual:checked').val();
      if(notamanual=="1"){
        alert("Anda ingin menggunakan nomor nota manual");
        $('input[name=notain]').removeAttr('readonly');
      }
      else {
        alert("Kembali menggunakan nomor nota autosistem");
        $('input[name=notain]').attr('readonly', true);
      }
    }
      

    id = '<?= $_GET['id'] ?>';
    nota = $('#notainput').val();
    jenis = '<?= $jenis ?>';


    function batal_order(){
      nota = $('#notainput').val();
      location.href="batal_order.php?id="+id+"&no_nota="+nota+"";
    }

    function backlayanan(){
      nota = $('#notainput').val();
      if(confirm("Ingin mengganti layanan?")){
        location.href="batal_order.php?id="+id+"&no_nota="+nota+"";
      }      
    }

    function kiloan(i){
      kiloan = $('#kiloan'+i).data('id');
      $('#parfumback').append('<a class="popup-close" href="#'+kiloan+'"><img src="back.png" /></a>');
    }

    function back(){
      idselect = '<?= $jenis ?>';
    }

    function itemharga_potongan(){
      item = $('#itemhargapotongan').val().split("-");
      kategori = $('#itemkategori').val(item[2]);
      level = $('#itemlevel').val(item[3]);
      $('#itempotongan').val(item[0]);
      $('#hargapotongan').val(item[1]);
      $('#jumlahitem').val(1);      
    }

    function itemharga_cks(){
      item = $('#itemhargacks').val().split("-");
      $('#itemcks').val(item[0]);
      $('#hargacks').val(item[1]);
      $('#beratcks').val(item[2]);
    }

    function itemharga_ckl(){
      item = $('#itemhargackl').val().split("-");
      $('#itemckl').val(item[0]);
      $('#hargackl').val(item[1]);
      $('#beratckl').val(item[2]);
    }

    function itemharga_ck(){
      item = $('#itemhargack').val().split("-");
      $('#itemck').val(item[0]);
      $('#hargack').val(item[1]);
      $('#beratck').val(item[2]);
    }

    function itemharga_ss(){
      item = $('#itemhargass').val().split("-");
      $('#itemss').val(item[0]);
      $('#hargass').val(item[1]);
      $('#beratss').val(item[2]);
    }

    function tambah_potongan(){
      form = $('#fpotongan');
      nota = form.find('#notain').val();
      item = $('#itempotongan').val();
      harga = $('#hargapotongan').val();
      jumlah = $('#jumlahitem').val();
      ket = $('input[name=keteranganpotongan]').val(); 
      kategori = $('#itemkategori').val();
      level = $('#itemlevel').val();
      if(harga>0){
        $('#itemhargapotongan').val('0');
        $('#itempotongan').val('');
        $('#hargapotongan').val('');
        $('#jumlahitem').val('0');
        $('#notamanual[value=1]').attr('disabled', true);
        form.find('#notain').attr('readonly', true);
        $.ajax({
          url     : 'act/simpan_transaksi.php',
          data    : {id:id,nota:nota,item:item,harga:harga,berat:"0",jumlah:jumlah,ket:ket,simpanlayanan:"cks",layanan:jenis},
          method  : 'POST',
          beforeSend : function(){
            $('#rincian_potongan').html("<span>Memuat..</span>").css('text-align','center');
          },
          success : function(data){
            $('#notainput').val(data);            
            $('#rincian_potongan').load('include/rinc_potongan.php?id='+id);  
            $('#itemhargapotongan').load('include/pil_potongan.php?kategori='+kategori+'&level='+level+'&id='+id);          
            $('input[name=simpanpotongan]').attr('onclick', 'simpan_potongan()');
          }
        })
      }  
        
    }

    function simpan_potongan(){
      location.href="#pilihanparfum";
      $('#parfumback').append('<a class="popup-close" href="#potongan"><img src="back.png" /></a>');
    }

    function simpan_cks(){ 
      form = $('#fcucikeringsetrika');
      nota = form.find('#notain').val();
      item = $('#itemcks').val();
      harga = $('#hargacks').val();
      berat = $('#beratcks').val();
      ket = $('input[name=keterangan]').val();

      if(harga>0){
        location.href="#pilihanparfum";
      }
      $.ajax({
        url     : 'act/simpan_transaksi.php',
        data    : {id:id,nota:nota,item:item,harga:harga,berat:berat,jumlah:"1",ket:ket,simpanlayanan:"cks",layanan:jenis},
        method  : 'POST',
        success : function(data){
          $('#notainput').val(data);      
        }
      })
    }

    function simpan_ckl(){   
      form = $('#fcucikeringlipat');
      nota = form.find('#notain').val();
      item = $('#itemckl').val();
      harga = $('#hargackl').val();
      berat = $('#beratckl').val();
      ket = $('input[name=keteranganckl]').val();
      if(harga>0){
        location.href="#pilihanparfum";
      }
      $.ajax({
        url     : 'act/simpan_transaksi.php',
        data    : {id:id,nota:nota,item:item,harga:harga,berat:berat,jumlah:"1",ket:ket,simpanlayanan:"cks",layanan:jenis},
        method  : 'POST',
        success : function(data){
          $('#notainput').val(data);          
        }
      })
    }

    function simpan_ck(){  
      form = $('#fcucikering');
      nota = form.find('#notain').val();  
      item = $('#itemck').val();
      harga = $('#hargack').val();
      berat = $('#beratck').val();
      ket = $('input[name=keteranganck]').val();
      if(harga>0){
        location.href="#pilihanparfum";
      }
      $.ajax({
        url     : 'act/simpan_transaksi.php',
        data    : {id:id,nota:nota,item:item,harga:harga,berat:berat,jumlah:"1",ket:ket,simpanlayanan:"cks",layanan:jenis},
        method  : 'POST',
        success : function(data){
          $('#notainput').val(data);          
        }
      })
    }

    function simpan_ss(){  
      form = $('#fsetrika');
      nota = form.find('#notain').val();     
      item = $('#itemss').val();
      harga = $('#hargass').val();
      berat = $('#beratss').val();
      ket = $('input[name=keteranganss]').val();
      if(harga>0){
        location.href="#pilihanparfum";
      }
      $.ajax({
        url     : 'act/simpan_transaksi.php',
        data    : {id:id,nota:nota,item:item,harga:harga,berat:berat,jumlah:"1",ket:ket,simpanlayanan:"cks",layanan:jenis},
        method  : 'POST',
        success : function(data){ 
          $('#notainput').val(data);         
        }
      })
    }

    function simpan_parfum(i){
      nota = $('#notainput').val();
      parfum = $('#pil_parfum'+i).val();
      location.href="#pilihanhanger";
      $.ajax({
        url     : 'act/simpan_transaksi.php',
        data    : {id:id,nota:nota,parfum:parfum,simpanlayanan:"parfum",layanan:jenis},
        method  : 'POST',
        success : function(data){        
        }
      })
    }

    interhanger = setInterval("fhanger()",30);
    function fhanger(){
      nota = $('#notainput').val();
      hanger = $('#beli_hanger').val();
      plastikhanger = $('#beli_plastikhanger').val();
      jumlah = hanger*2500+plastikhanger*2000;
      $('#chargehanger').val(jumlah);
    }

    function simpan_hanger(){
      nota = $('#notainput').val();
      hangersendiri = $('input[name=hangersendiri]:checked').val();
      hanger = $('#beli_hanger').val();
      plastikhanger = $('#beli_plastikhanger').val();
      location.href="#pilihanexpress";
      $.ajax({
        url     : 'act/simpan_transaksi.php',
        data    : {id:id,nota:nota,hangersendiri:hangersendiri,hanger:hanger,plastikhanger:plastikhanger,simpanlayanan:"hanger",layanan:jenis},
        method  : 'POST',
        success : function(data){          
        }
      })
    }

    function simpan_express(i){
      nota = $('#notainput').val();
      charge = i;
      location.href="#pilihanvoucher";
      $.ajax({
        url     : 'act/simpan_transaksi.php',
        data    : {id:id,nota:nota,charge:charge,simpanlayanan:"express",layanan:jenis},
        method  : 'POST',
        success : function(data){  
        }
      })
    }

    function kode_voucher(){
      kode = $('#kodevoucher').val();
      nota = $('#notainput').val();
      if(kode!=''){
        $.ajax({
          url     : 'act/simpan_transaksi.php',
          data    : {id:id,nota:nota,kode:kode,simpanlayanan:"voucher",layanan:jenis},
          method  : 'POST',
          beforeSend : function(){
            $('.info').text("Sedang mengecek kode promo...");
          },
          success : function(data){
            $('.info').text(data);
          }
        })
      }      
    }

    function tampilkan_order(){
      location.href="index.php?id="+id+"&jenis="+jenis+"&nota="+nota+"#tampilanrincian";
    }
    
</script>