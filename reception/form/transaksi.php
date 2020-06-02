<?php
include "../config.php";
?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#kategori").change(function(){
    var kategori = $("#kategori").val();
    $.ajax({
        url: "ambilkota.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#itemklp").html(msg);
        }
    });
  });


  $("#kategori1").change(function(){
    var kategori = $("#kategori1").val();
    $.ajax({
        url: "ambilkota.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#itemklp").html(msg);
        }
    });
  });

  $("#kategori2").change(function(){
    var kategori = $("#kategori2").val();
    $.ajax({
        url: "ambilkota.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#itemklp").html(msg);
        }
    });
  });

  $("#kategori3").change(function(){
    var kategori = $("#kategori3").val();
    $.ajax({
        url: "ambilkota.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#itemklp").html(msg);
        }
    });
  });

  $("#kategori4").change(function(){
    var kategori = $("#kategori4").val();
    $.ajax({
        url: "ambilkota.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#itemklp").html(msg);
        }
    });
  });

});

</script>
<script type="text/javascript">
 function validasi()
    {
        var itemklp=document.forms["form1"]["itemklp"].value;
		if (itemklp==null || itemklp=="")
          {
          alert("Item tidak boleh kosong !");
          return false;
          };
	}

 function validasi1()
    {
        var itemklp=document.forms["form2"]["itemklp"].value;
		if (itemklp==null || itemklp=="")
          {
          alert("Item tidak boleh kosong !");
          return false;
          };
	}
</script>

<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Kiloan
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                        <div class="form-group">
                                        <form action="act_order.php" method="get" onSubmit="return validasi()" id="form1">
                                                <label class="control-label col-xs-3" for="kiloan">
                                                   Item
                                                </label>
                                                <div class="col-xs-9" >
                                                <?php
                                                if (isset($_GET['status'])){
												?>
                                                <input type="hidden" name="status" value="<?php echo $_GET['status'];?>" />
                                                 <select name="itemklp" class="form-control">
                                                 	<option value="">Pilih Item</option>
													<?php
        	                                         $qitem = mysqli_query($con, "select * from item_spk where jenis_item='k'");
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['id']; ?>">
                                                       <?php echo $ritem['nama_item']." - Rp.".$ritem['disk']; ?>
                                                     </option>
												<?php 
												 }
												}
												else{ 												
												?>                                                 
                                                 <select name="itemklp" class="form-control">
                                                 	<option value="">Pilih Item</option>
													<?php
        	                                         $qitem = mysqli_query($con, "select * from item_spk where jenis_item='k'");
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['id']; ?>">
                                                       <?php echo $ritem['nama_item']." - Rp.".$ritem['harga']; ?>
                                                     </option>
												<?php 
												 }
												}											
?>                                                                        
                                                 </select>
                                                </div><br><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="ket1" name="ket1" class="form-control" placeholder="keterangan item" width="100%">
                                                </div><br /><br>
                                        </div>

                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Rincian
                                            </label>
                                            <div class="col-xs-9" >
                                                <label><input type="checkbox" id="hanger_own" name="hanger_own"> Hanger Sendiri</label>                                          
                                                <br>
                                                <label><input type="checkbox" id="deliver" name="deliver"> Delivery</label>                                                                                          
                                            </div>
                                            <br><br>
                                        </div>
                                        
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Parfum
                                            </label>
                                            <div class="col-xs-9" >
                                                <label><input type="radio" name="parfum" id="parfum" value="0" checked=""> Normal</label> 
                                                <label><input type="radio" name="parfum" id="parfum" value="extra"> Extra</label>
                                                <label><input type="radio" name="parfum" id="parfum" value="no"> No</label>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Charge
                                            </label>
                                            <div class="col-xs-9" >
                                                <select class="form-control" id="charge" name="charge">
                                                    <option value="0">Pilih charge</option>

													<?php
        	                                         $qitem1 = mysqli_query($con, "select * from item_spk where jenis_item='k' and nama_item like '%express%'");
		  											 while ($ritem1 = mysqli_fetch_array($qitem1)){
                		                            ?>
                                                     <option value="<?php echo $ritem1['id']; ?>">
                                                       <?php echo $ritem1['nama_item']." - Rp.".$ritem1['harga']; ?>
                                                     </option>
												<?php 
												 }
?>                                                                        
                                                </select>                                          
                                            </div>
                                            <br><br>
                                        </div>
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Hanger
                                            </label>
                                            <div class="col-xs-9" >
                                                <input type="text" class="form-control" id="hanger" name="hanger">                                            </div><br><br>
                                        </div>
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    P.Hanger
                                            </label>
                                            <div class="col-xs-9" >
                                                <input type="text" class="form-control" id="hanger_plastic" name="hanger_plastic">
                                            </div>
                                            <br>
                                        </div>
                                        <input type="hidden" readonly class="easyui-textbox" name="beratitem" id="beratitem" required />
                                        <br>
                                </fieldset>
                                                        <input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
                                                        <input type="hidden" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $r['nama_customer'] ?>" />

                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="voucher">
                                                                voucher
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input autocomplete="off" type="text" class="form-control" name="voucher" id="voucher"  onkeydown="return tabOnEnter(this,event)" />                                                               
                                                                <input type="hidden" class="form-control" autocomplete="off" name="id_cust" id="id_cust" value="<?php echo $r['id']; ?>" />
                                                        </div>
                                                        <span id="pesan">
                                                        </span><br><br>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="cabang">
                                                                Lgn/sub
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <select class="form-control" name="cabang" id="cabang">
                                                                        <option value="">
                                                                                --
                                                                        </option>
<?php
	                                         $qlgn = mysqli_query($con, "select * from qnc_lgn");
											 while ($rlgn = mysqli_fetch_array($qlgn)){
                                              ?>
                                                                        <option value="<?php echo $rlgn['nama_lgn']; ?>">
                                                                           <?php echo $rlgn['keterangan']; ?>
                                                                        </option>
												<?php 
												 }
?>                                                                        
                                                                </select>
                                                        </div><br><br>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="ket">
                                                                Keterangan
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <textarea type="text" class="form-control" name="ket" id="ket">
                                                                </textarea><br>
                                                        </div>
                                                </div>                                
                                        <input type="submit" class="btn btn-success btkiloan" value="Save Kiloan" style="width:100%; background-color:#6C0;"/>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Potongan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                        <form action="act_order_potongan.php" method="get" onSubmit="return validasi1()" id="form2" name="form2">
                                        <input type="hidden" name="jenis" value="potongan" />
                                        <input type="hidden" readonly class="easyui-textbox" name="beratitem" id="beratitem" required />
                                                        <input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
                                                        <input type="hidden" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $r['nama_customer'] ?>" />
                                        
<?php                                        
$ot = $_SESSION['nama_outlet'];

$query = "SELECT * FROM reception WHERE nama_outlet='$ot' order by no_so desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['no_so'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 5, 6);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;

if ($ot=="Toddopuli"){
   $char = "SDTDL";
   $char1 = "TDL";	
}elseif ($ot=="Landak"){
	$char = "SDLDK";
	$char1 = "LDK";	
}elseif ($ot=="Baruga") {
	$char = "SDBRG";
	$char1 = "BRG";
}
elseif ($ot=="Cendrawasih"){
	$char = "SDCDW";
	$char1 = "CDW";
}
elseif ($ot=="BTP"){
	$char = "SDBTP";
	$char1 = "BTP";
}
elseif ($ot=="DAYA"){
	$char = "SDDYA";
	$char1 = "DYA";
}elseif ($ot=="support"){
	$char = "SDSPT";
	$char1 = "SPT";
}elseif ($ot=="mojokerto"){
	$char = "SDMJK";
	$char1 = "MJK";
}
 
// membuat format nomor transaksi berikutnya
$noso = $char.sprintf('%06s', $nextNoUrut1);
$no_nota=$noso;
$t = date('Y');
$m = date('m');
$d = date('d');
$h = date('h');
$i = date('i');
$new_nota = $char1.$t.$m.$d.$h.sprintf('%06s', $nextNoUrut1);
?>                                        
                                        <div class="form-group">
                                               <?php
											   if (isset($_GET['nota'])){
                                                $no_nota = $_GET['nota'];
											   ?>
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        No. Nota : <?php echo $_GET['nota']; ?>
												</label>
                                                <div class="col-xs-9" >
                                                </div><br /><br>
											   <?php	
											   }
                                                $qre = mysqli_query($con, "select * from detail_penjualan where no_nota = '$no_nota' order by id desc limit 0,1");
												$rre = mysqli_fetch_array($qre);
												$carikat = mysqli_query($con, "select * from item_spk where nama_item = '$rre[item]'");
												$rcariket = mysqli_fetch_array($carikat);
												?>
                                        </div>
                                        <div class="form-group">                                        
                                                <label class="control-label col-xs-3" for="kiloan">
                                                   Item
                                                </label>
                                                <div class="col-xs-9" >
                                                <?php
                                                if (isset($_GET['status'])){
												?>
                                                <input type="hidden" name="status" value="<?php echo $_GET['status'];?>" />
                                                 <select name="itemklp" class="form-control" id="itemklp">
                                                 	<option value="">Pilih Item</option>
													<?php
        	                                         $qitem = mysqli_query($con, "select * from item_spk where jenis_item='p'");
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['id']; ?>">
                                                       <?php echo $ritem['nama_item']." - Rp.".$ritem['disk']; ?>
                                                     </option>
													<?php 
													 }
													?>
                                                 </select>
                                                <?php	
												}
												else
												{ 
												?>
                                                 
                                                 <select name="itemklp" class="form-control" id="itemklp">
                                                 	<option value="">Pilih Item</option>                                                    
													<?php
													if (isset($_GET['nota'])){
$qitem = mysqli_query($con, "select * from item_spk where jenis_item='p' and kategory='$rcariket[kategory]'");														
														}
													else{
$qitem = mysqli_query($con, "select * from item_spk where jenis_item='p'");														
														}
													
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['id']; ?>">
                                                       <?php echo $ritem['nama_item']." - Rp.".$ritem['harga']; ?>
                                                     </option>
												<?php 
												 }
												?>
                                                </select>
<?php
												}																							
?>
                                                </div><br><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Jumlah
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah potongan" width="100%" required="required">
                                                </div><br /><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="ket1" name="ket1" class="form-control" placeholder="keterangan item" width="100%">
                                                </div><br /><br>
                                        </div>
                                        <a href="index.php?id=<?php echo $_GET['id']; ?>&status=<?php echo $_GET['status']; ?>&nota=<?php echo $no_nota; ?>&lanjut=ya">
                                        <input type="button" class="btn btn-success btpotongan" value="Selesai" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <input type="submit" class="btn btn-success btpotongan" value="Save Item" style="width:49%; background-color:#6C0;"/>
                                      </form>

                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
<?php
    include "include/daftar_faktur.php";
?>