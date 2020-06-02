<?php
include 'header.php';
include '../config.php';
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d");
$id   = $_GET['id'];
$sql  = $con->query("select * from customer WHERE id = '$id'");
$r    = $sql->fetch_assoc();

$ot   = $_SESSION['nama_outlet'];
	if($r['member'] == '1' && $r['tgl_akhir'] >= $jam1  ){
			$mb = "1";
			$kl = "0.00004";
		}   
		else
		{
			$mb = "0";
			$kl = "0";
		}
		if($r['lgn'] == '1'){
			$lg         = "1";
			$sisa_kuota = $r['sisa_kuota'];
		}
		else
		{
			$lg         = "0";
			$sisa_kuota = "";
		}

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}



$query   = "SELECT max(no_faktur) AS last FROM faktur_penjualan  WHERE nama_outlet='$ot' LIMIT 1";
$hasil   = mysqli_query($con,$query);
$k       = mysqli_fetch_array($hasil);
$no_urut = $k['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//fCDW000001
$terakhir= (int)substr($no_urut, 4, 6);
// nomor urut ditambah 1
$nextNoUrut = $terakhir + 1;

if($ot == "Toddopuli"){
	$char = "FTDL";

}
elseif($ot == "Landak"){
	$char = "FLDK";


}
elseif($ot == "Baruga"){
	$char = "FBRG";

}
elseif($ot == "Cendrawasih"){
	$char = "FCDW";

}
elseif($ot == "BTP"){
	$char = "FBTP";

}
elseif($ot == "DAYA"){
	$char = "FDYA";

}
elseif($ot == "support"){
	$char = "FSPT";

}elseif($ot == "mojokerto"){
	$char = "FMJK";

}elseif($ot == "Boulevard"){
	$char = "FBLV";

}

// membuat format nomor transaksi berikutnya
$nofaktur = $char.sprintf('%06s', $nextNoUrut);

?>
<link rel="stylesheet" type="text/css" href="../lib/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="../lib/themes/icon.css" />
<script type="text/javascript" src="../lib/js/jquery.easyui.min.js">
</script>
<head>
	<title>
		Transaksi Penjualan
	</title>
	<style>
		@media all
		{
			.page-break
			{
				display: none;
			}
		}@media print
		{
			.page-break
			{
				display: block;
				page-break-before: always;
			}
		}
                .just_kiloan{
                    display:none;
                }
	</style>


</head>
<body>
    <div class="container" style=" margin:0 auto; padding: 20px; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:20px; color:#000000;">
        <input type="hidden" readonly class="form-control" autocomplete="off" name="jumlahpoin" id="jumlahpoin" value="<?php echo $r['poin'] ?>" required/>

        <input type="hidden" readonly class="form-control" autocomplete="off" name="kali" id="kali" value="<?php echo $kl ?>" required/>
        <input type="hidden" readonly class="form-control" autocomplete="off" name="tambahpoin" id="tambahpoin" required/>
        <input type="hidden" readonly class="form-control" autocomplete="off" name="totalpoin" id="totalpoin" required/>
        <fieldset>
                <legend align="center" >
                    <strong style="color:#85B92E">
                                Transaksi Penjualan
                        </strong>
                </legend>

                <div class="row featurette">

                        <div class="col-md-4 col-md-offset-0" >
                                <!-- ATAS KIRI -->
                                <fieldset>
                                       
                                        1. Klik Kiloan atau potongan <br>
                                        2. Pilih jenis item di kolom item<br>
                                        3. Jika jumlahnya lebih dari 1 ubah di kolom jumlah<br>
                                        4. Klik Simpan rincian, tunggu sampe table rincian selesai loading<br>
                                        5. Klik simpan order.<br>
                                        6. Klik Pembayaran jika melakukan pembayaran.<br>
                                        7. Klik hapus jika ada yang salah.<br>
                                        <div>
                                        <input type="button" class="btn btn-success btkiloan" value="Kiloan"/>
                                        <input type="button" class="btn btn-success btpotongan" value="Potongan"/>
                                        <input type="button" class="btn btn-success jdlgn" name="jdlgn" id="jdlgn" value="Jadi Langganan"/><br /><br />

                                        <a href="javascript:;" data-toggle="modal" style="visibility:hidden" data-target="#modal-langganan" type="button" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" >
                                                Deposit Langganan
                                        </a>

                                        <a href="javascript:;" data-toggle="modal"  data-target="#modal-member" type="button" class="btn btn-success btmember" name="btmember" id="btmember" >
                                                Membership
                                        </a>
                                        </div>
                                        <br>
                                        <div id="printdp">
                                        </div>
                                        <div id="printmbr">
                                        </div>
                                        <div id="printorder">
                                        </div>                                                                                
                                </fieldset>
                        </div>
                        <div class="col-md-4 col-md-offset-0" >
                                <!-- ATAS TENGAH -->
                                <fieldset>
                                        
                                        <div class="langganan">
                                                <label class="control-label col-xs-10 col-xs-offset-0">
                                                        Kuota :
                                                        <font color="#85B92E" size="8">
                                                                <?php echo rupiah($r['sisa_kuota']) ?>
                                                        </font>
                                                </label>
                                                <input type="hidden" class="form-control" name="lgn" id="lgn" value="<?php echo $lg ?>"/>
                                                <input type="hidden" readonly class="form-control" autocomplete="off" name="sisa_kuota" id="sisa_kuota" value="<?php echo $sisa_kuota ?>" required/>
                                                <input type="hidden" readonly class="form-control" autocomplete="off" name="kuota_sekarang" id="kuota_sekarang" value="<?php echo $sisa_kuota ?>"  required="true"/>
                                        </div>
                                </fieldset>
                        </div>
                        <div class="col-md-4 col-md-offset-0" >
                                <!-- ATAS KANAN -->
                                <fieldset>

                                        <label class="control-label col-xs-10 col-xs-offset-0">
                                                Nama Customer : <?php echo $r['nama_customer'] ?>
                                        </label>
                                        <label class="control-label col-xs-10 col-xs-offset-0">
                                                Alamat : <?php echo $r['alamat'] ?>
                                        </label>
                                        <label class="control-label col-xs-10 col-xs-offset-0">
                                                No Telp : <?php echo $r['no_telp'] ?>
                                        </label>
                                        <label class="control-label col-xs-10 col-xs-offset-0">
                                                Email: <?php echo $r['email'] ?>
                                        </label>
                                        <div class="member">
                                                <label class="control-label col-xs-10 col-xs-offset-0">
                                                        Tangal Join : <?php echo $r['tgl_join'] ?>
                                                </label>
                                                <label class="control-label col-xs-10 col-xs-offset-0">
                                                        Tangal Akhir : <?php echo $r['tgl_akhir'] ?>
                                                </label>
                                                <label class="control-label col-xs-10 col-xs-offset-0">
                                                        Total POIN :
                                                        <font color="#85B92E" size="8">
                                                                <?php echo $r['poin'] ?>
                                                        </font>
                                                </label>
                                                <input type="hidden" class="form-control" name="mbr" id="mbr" value="<?php echo $mb ?>"/>
                                                <input type="hidden" class="form-control" name="jmbr" id="jmbr" value="<?php echo $r['jenis_member'] ?>"/>
                                        </div>
                                </fieldset>
                        </div>

                </div>
<hr>
                <!-- START THE FEATURETTES -->
                
                <div class="row featurette">


                        <div class="col-md-4 col-md-offset-0" >
                                <!-- BAWAH KIRI -->
                                <fieldset>
                                        <legend align="center" >
                                                <strong style="color:#85B92E">
                                                        Input
                                                </strong>
                                        </legend>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="kiloan">
                                                        Item
                                                </label>
                                                <div class="col-xs-4" >
                                                        <input required name="itemklp" id="itemklp" class="easyui-combobox"
                                                        name="language"
                                                        data-options="
                                                        valueField:'id',
                                                        textField:'nama_item',
                                                        panelHeight:'auto',
                                                        onSelect: function(rec){

                                                        var mbr=$('#mbr').val();
                                                        var lgn=$('#lgn').val();
                                                        var jmbr=$('#jmbr').val();
                                                        $('#beratitem').textbox('setValue', rec.berat);

                                                        if((mbr == '1' && jmbr !='Red') || lgn=='1' ){

                                                        $('#hargaitem').textbox('setValue', rec.disk);
                                                        }else{


                                                        $('#hargaitem').textbox('setValue', rec.harga);
                                                        }

                                                        if(rec.id == '186' || rec.id == '189'){
                                                        $('#hargaitem').textbox('readonly',false);
                                                        }else{
                                                        $('#hargaitem').textbox('readonly',false);
                                                        }

                                                        if(rec.id == '183' || rec.id == '184'){
                                                        $('#express1').combobox('setValue','1');
                                                        }
                                                        }
                                                        ">
                                                </div><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-6" >
                                                        <input type="text" id="ket1" name="ket1" class="easyui-textbox" placeholder="keterangan item">
                                                </div><br>
                                        </div>

                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Rincian
                                            </label>
                                            <div class="col-xs-9" >
                                                <label><input type="checkbox" id="hanger_own"> Hanger Sendiri</label>                                          
                                                <br>
                                                <label><input type="checkbox" id="deliver"> Delivery</label>                                                                                          
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
                                        

                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Jumlah
                                                </label>
                                                <div class="col-xs-6" >
                                                        <input type="hidden" id="total" name="total" />
                                                        <input type="number" class="easyui-textbox" name="jumlahitem" id="jumlahitem" required />
                                                </div><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="hargaitem">
                                                        Harga
                                                </label>
                                                <div class="col-xs-6" >
                                                        <input type="number" class="easyui-textbox" name="hargaitem" id="hargaitem" required />
                                                </div><br>
                                        </div>
                                    
                                        
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Charge
                                            </label>
                                            <div class="col-xs-9" >
                                                <select class="easyui-combobox" id="charge">
                                                    <option value="0">Pilih charge</option>
                                                    <option value="express">Express Kiloan</option>
                                                    <option value="double">Double Express Kiloan</option>
<!--                                                    <option value="hanger">Hanger</option>
                                                    <option value="hanger_plastic">Plastik Hanger</option>-->
                                                </select>                                          
                                            </div>
                                            <br>
                                        </div>
                                    
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Hanger
                                            </label>
                                            <div class="col-xs-9" >
                                                <input type="text" class="easyui-textbox" id="hanger">                                          
                                            </div>
                                            <br>
                                        </div>
                                    
                                    
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    P.Hanger
                                            </label>
                                            <div class="col-xs-9" >
                                                <input type="text" class="easyui-textbox" id="hanger_plastic">
                                            </div>
                                            <br>
                                        </div>
                                        <input type="hidden" readonly class="easyui-textbox" name="beratitem" id="beratitem" required />
                                        <br>
                                        <input type="button" value="Tambah" name="simpanordersementara" id="simpanordersementara"  class="btn btn-success">
                                </fieldset>


                        </div>


                        <div class="col-md-4 col-md-offset-0"  >
                                <fieldset>
                                        <legend align="center" >
                                                <strong style="color:#85B92E">
                                                        Rincian Order
                                                </strong>
                                        </legend>
                                        <table id="dgrincian" class="easyui-datagrid" style="width:350px;height:200px"
                                url="get_rincian_order_temp.php" toolbar="#toolbar"
                                fitColumns="true" singleSelect="true" rownumbers="false" pagination="false"
                                >
                                                <thead>
                                                        <tr>
                                                                <th field="item" width="120">
                                                                        Item
                                                                </th>
                                                                <th field="jumlah" width="20">
                                                                        Jumlah
                                                                </th>
                                                                <th field="harga" width="50">
                                                                        Harga
                                                                </th>
                                                                <th field="total" width="50">
                                                                        Total
                                                                </th>
                                                        </tr>
                                                </thead>
                                        </table>
                                        <div id="toolbar">
                                                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="hapusorder()">
                                                        Hapus
                                                </a>
                                        </div>

                                        <div id="status">
                                        </div>

                                        <br>
                                        <form action="selesai_order.php" method="get">
                                                <div class="form-group">
                                                        <label for="no_nota" class="control-label col-xs-3">
                                                                No Nota
                                                        </label>
                                                        <input type="hidden" readonly class="form-control" autocomplete="off" name="email" id="email" value="<?php echo $r['email'] ?>" required/>


                                                        <input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
                                                        <input type="hidden" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $r['nama_customer'] ?>" />
                                                        <div class="col-xs-9" >
                                                                <input type="text" class="form-control" autocomplete="off" value="Auto" name="no_nota" id="no_nota" onKeyDown="return tabOnEnter(this,event)"  required="true"/>
                                                        </div><br><br>
                                                </div>
                                                <div class="form-group">
                                                
<label class="control-label col-xs-3" for="jenis">
Main Total
</label>
                                                        <div class="col-xs-9" >
<?php
include '../config.php';
	$st = mysqli_query($con, "select sum(total) as main, sum(berat) as berat from rincian_order_temp where id_customer='$_GET[id]' and item not like '%expres%'");
	$rst = mysqli_fetch_array($st);
?>
<input type="text" class="form-control" name="maintotal" id="maintotal" readonly value="<?php echo $rst['main']; ?>" />
                                                        </div><br><br>
</div>
                                                
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="berat">
                                                                Berat Cucian
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input type="text" class="form-control" name="berat" id="berat" value="<?php echo $rst['berat']; ?>" readonly />

                                                        </div><br><br>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="jenis">
                                                                Sub Total
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input type="number" class="form-control" name="subtotalorder" id="subtotalorder" readonly required />

                                                        </div><br><br>
                                                </div>
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
                                                        <label class="control-label col-xs-3" for="diskon">
                                                                Diskon
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input type="text" class="form-control" name="diskon" id="diskon" readonly />
                                                                <input type="hidden" class="form-control" value="0" name="diskonrp" id="diskonrp" readonly />

                                                        </div><br><br>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="totalorder" >
                                                                Total
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input type="number" class="form-control" name="totalorder" id="totalorder" readonly required />

                                                        </div><br><br>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="jenis">
                                                                Jenis Cucian
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input type="text" class="form-control" name="jenis" id="jenis" required value="k" />

                                                        </div><br><br>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="express1">
                                                                Express
                                                        </label>
                                                            <div class="col-xs-9">
                                                                <select class="easyui-combobox" name="express1" id="express1" style="width:100%;">
                                                                        <option value="">--</option>
                                                                        <option value="1">Express</option>
                                                                </select>
                                                            </div>    
                                                    <br>
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
                                                                        <option value="lgn">
                                                                                Langganan
                                                                        </option>
                                                                        <option value="dlv">
                                                                                Delivery
                                                                        </option>                                                                      
                                                                        <option value="sub-Tamangapa">
                                                                                sub-Tamangapa
                                                                        </option>
                                                                        <option value="sub-abdesir">
                                                                                sub-abdesir
                                                                        </option>
                                                                        <option value="sub-jappa">
                                                                                sub-jappa
                                                                        </option>
                                                                        <option value="sub-manggarupi">
                                                                                sub-manggarupi
                                                                        </option>
                                                                        <option value="sub-h.bau">
                                                                                sub-h.bau
                                                                        </option>
                                                                        <option value="sub-alaudin">
                                                                                sub-alaudin
                                                                        </option>                                                                        
                                                                        <option value="hvenus">
                                                                                Hotel Venus
                                                                        </option>
                                                                        <option value="hastra">
                                                                                Hotel Astra
                                                                        </option>
                                                                        <option value="hcontinent">
                                                                                Hotel Continent
                                                                        </option>
                                                                        <option value="hvindikap">
                                                                                Hotel Vindikap
                                                                        </option>



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
                                            <input name="cuci" class="btn btn-success" type="submit" id="cuci" value="Simpan Order" style="float:right;">

                                        </form>

                                </fieldset>
                        </div>

                        <div class="col-md-4 col-md-offset-0">
                                <fieldset>
                                        <legend align="center" >
                                                <strong style="color:#85B92E">
                                                        Daftar Order
                                                </strong>
                                        </legend>
                                        <table id="dgorder" class="easyui-datagrid" style="width:350px;height:200px"
                                url="get_order.php" toolbar="#tb"
                                fitColumns="true" singleSelect="true" rownumbers="false" pagination="false"
                                >
                                                <thead>
                                                        <tr>
                                                                <th field="no_nota" width="50">
                                                                        No nota
                                                                </th>
                                                                <th field="tgl_input" width="50">
                                                                        Tanggal
                                                                </th>

                                                                <th field="total_bayar" width="50">
                                                                        Total
                                                                </th>

                                                        </tr>
                                                </thead>
                                        </table>
                                        <div id="tb">
                                                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="voidorder()">
                                                        Void Order
                                                </a>
                                        </div> <br>

                                        <a  class="btn btn-success" href="transaksi_pembayaran.php?id=<?php echo $r['id']; ?>">
                                                Pembayaran
                                        </a>

                                </fieldset>
                        </div>
                </div>
                <hr>
                <div class="row featurette">
                        <div class=""  >
                                <fieldset>
                                        <legend align="center" >
                                                <strong style="color:#85B92E">
                                                        Belum Diambil
                                                </strong>
                                        </legend>
                                        <table id="belumambil" class="display">
                                                <thead>
                                                        <tr>
                                                                <th>
                                                                        reprint
                                                                </th>
                                                                <th>
                                                                        Tanggal Masuk
                                                                </th>
                                                                <th>
                                                                        No Nota
                                                                </th>
                                                                <th>
                                                                        Nama Customer
                                                                </th>
                                                                <th>
                                                                        Cuci
                                                                </th>
                                                                <th>
                                                                        Setrika
                                                                </th>
                                                                <th>
                                                                        Packing
                                                                </th>
                                                                <th>
                                                                        kembali
                                                                </th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        $outlet = $_SESSION['nama_outlet'];
                                                        $query  = "SELECT * FROM reception where  ambil=false and id_customer='$id' ORDER BY tgl_input" ;
                                                        $tampil = mysqli_query($con, $query);


                                                        while($data = mysqli_fetch_array($tampil)){
                                                                ?>
                                                                <tr>
                                                                        <td>

                                                                                <a class="btn btn-xs btn-success" href="reprint_order.php?no_nota=<?php echo $data['no_nota']; ?>">
                                                                                        Reprint
                                                                                </a>
                                                                        </td>
                                                                        <td>
                                                                                <?php echo $data['tgl_input'];?>
                                                                        </td>
                                                                        <td>
                                                                                <?php echo $data['no_nota'];?>
                                                                        </td>
                                                                        <td>
                                                                                <?php echo $data['nama_customer'];?>
                                                                        </td>
                                                                        <td>
                                                                                <?php
                                                                                if($data['tgl_cuci'] <> "0000-00-00 00:00:00")
                                                                                {
                                                                                        echo ''.$data['tgl_cuci'].'';
                                                                                }
                                                                                else
                                                                                {
                                                                                        echo 'belum';
                                                                                };
                                                                                ?>


                                                                        </td>
                                                                        <td>
                                                                                <?php
                                                                                if($data['tgl_setrika'] <> "0000-00-00 00:00:00")
                                                                                {
                                                                                        echo ''.$data['tgl_setrika'].'';
                                                                                }
                                                                                else
                                                                                {
                                                                                        echo 'belum';
                                                                                };
                                                                                ?>
                                                                        </td>
                                                                        <td>
                                                                                <?php
                                                                                if($data['tgl_packing'] <> "0000-00-00 00:00:00")
                                                                                {
                                                                                        echo ''.$data['tgl_packing'].'';
                                                                                }
                                                                                else
                                                                                {
                                                                                        echo 'belum';
                                                                                };
                                                                                ?>
                                                                        </td>
                                                                        <td>
                                                                                <?php
                                                                                if($data['tgl_kembali'] <> "0000-00-00 00:00:00")
                                                                                {
                                                                                        echo ''.$data['tgl_kembali'].'';
                                                                                }
                                                                                else
                                                                                {
                                                                                        echo 'belum';
                                                                                };
                                                                                ?>
                                                                        </td>

                                                                </tr>

                                                                <?php
                                                        }
                                                        ?>
                                                </tbody>
                                        </table>
                                </fieldset>
                        </div>
                </div>

        </fieldset>

        <div id="modal-langganan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <input type="hidden" readonly class="form-control" autocomplete="off" name="sisa_kuota" id="sisa_kuota" value="<?php echo $sisa_kuota ?>" required/>
                                <input type="hidden" readonly class="form-control" autocomplete="off" name="kuota_sekarang_tambah" id="kuota_sekarang_tambah" required/>

                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                        &times;
                                                </span>
                                        </button>
                                        Deposit Langganan
                                </div>
                                <div class="modal-body">
                                        <form method="post" action="" id="form-input1" class="form-horizontal">

                                                <fieldset>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="paket">
                                                                        Pilih Paket
                                                                </label>
                                                                <div class="col-xs-6" >
                                                                        <select class="form-control" name="paket" id="paket">
                                                                                <option value="">
                                                                                        --
                                                                                </option>
                                                                                <option value="kilo30">
                                                                                        All Kiloan 30kg
                                                                                </option>
                                                                                <option value="singgle">
                                                                                        Paket Singglet
                                                                                </option>
                                                                                <option value="couple">
                                                                                        Paket Couple
                                                                                </option>
                                                                                <option value="custom">
                                                                                        Custom
                                                                                </option>
                                                                        </select>
                                                                </div><br>
                                                        </div>
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
                                        <button id="simpandepositlgn" class="btn btn-md btn-success">
                                                Simpan
                                        </button>
                                        <button class="btn btn-default" data-dismiss="modal">
                                                <i class="fa fa-close">
                                                </i>Batal
                                        </button>
                                </div>



                        </div>
                </div>
        </div>


        <div id="modal-member" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                        &times;
                                                </span>
                                        </button>
                                        Membership
                                </div>
                                <div class="modal-body">
                                        <form method="post" action="" id="form-input1" class="form-horizontal">

                                                <fieldset>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="jenis_member">
                                                                        Jenis
                                                                </label>
                                                                <div class="col-xs-4" >
                                                                        <select class="form-control" name="jenis_member" id="jenis_member">
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
                                                        </div><br>

                                                        <div class="form-group">
                                                                <label for="no_telp" class="control-label col-xs-3">
                                                                        Tgl Akhir
                                                                </label>
                                                                <div class="col-xs-4">
                                                                        <input type="text" readonly required name="tgl_akhir" class="form-control" id="tgl_akhir">
                                                                </div>
                                                        </div>

                                                        <div class="form-group">
                                                                <label for="hargapaket" class="control-label col-xs-3">
                                                                        Harga Paket
                                                                </label>
                                                                <div class="col-xs-4" >
                                                                        <input type="text" class="form-control" autocomplete="off" name="hargamember" id="hargamember" />
                                                                </div><br>
                                                        </div>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="carabayarlgn">
                                                                        Cara Bayar
                                                                </label>
                                                                <div class="col-xs-4" >
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
                                                                </div><br>
                                                        </div>

                                                </fieldset>




                                        </form>

                                </div>
                                <div class="modal-footer">
                                        <button id="simpanmember" class="btn btn-md btn-success">
                                                Simpan
                                        </button>
                                        <button class="btn btn-default" data-dismiss="modal">
                                                <i class="fa fa-close">
                                                </i>Batal
                                        </button>
                                </div>



                        </div>
                </div>
        </div>
    </div>    
</body>
<script>
	var mbr1 = $("#mbr").val();
	if	( mbr1=='1')
	{
		$('.member').show();
	}else
	{
		$('.member').hide();
	}

</script>

<script>
	var lg = $("#lgn").val();
	if	( lg=='1')
	{
		$('.langganan').show();
		$('.btdeposit').removeAttr("style");
$("#voucher").attr('readonly', 'readonly');


	}else
	{
		$('.langganan').hide();
		$("#carabayar option[value='kuota']").remove();
$("#voucher").removeAttr('readonly');
	}

</script>
<script type="text/javascript">
	function getrincianorder()
	{
		$('#dgrincian').datagrid('load',
			{
				
				id_customer: $('#id_cs').val()


			});
	}
	function getorder()
	{
		$('#dgorder').datagrid('load',
			{

				id_customer: $('#id_cs').val()


			});
	}

</script>
<script>

	//Inisiasi awal penggunaan jQuery
	$(document).ready(function()
		{
				
			$("#diskon").val('');
			$("#diskonrp").val('0');
			$("#jenis").val('');
		
			
			$('#jumlahitem').textbox('setValue','1');
			getorder();
			$('#dgorder').datagrid('reload');
			getrincianorder();
			$('#dgrincian').datagrid('reload');
			oTable = $('#belumambil').dataTable(
				{
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 50

				});

			//Ketika elemen class tampil di klik maka elemen class gambar tampil

			$('.btkiloan').click(function()
				{
                                        $(".just_kiloan").show();
					$('#jenis').val('k');
					$('#itemklp').combobox('reload', 'get_itemkiloan.php');
					$('#jumlahitem').textbox('readonly',true);
					getorder();
					$('#dgorder').datagrid('reload');
					getrincianorder();
					$('#dgrincian').datagrid('reload');


				});

			$('.btpotongan').click(function()
				{
                                        $(".just_kiloan").hide();
					$('#jenis').val('p');
					$('#itemklp').combobox('reload', 'get_itempotongan.php')
					$('#jumlahitem').textbox('readonly',false);
					getorder();
					$('#dgorder').datagrid('reload');
					getrincianorder();
					$('#dgrincian').datagrid('reload');


				});



		});
</script>
<script>


</script>
<script type="text/javascript">
	function printout()
	{
		var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
		newWindow.document.write(document.getElementById("status").innerHTML);
		newWindow.print();

	}
</script>
<script type="text/javascript">
	function print2()
	{
		var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
		newWindow.document.write(document.getElementById("printdp").innerHTML);
		newWindow.print();

	}
</script>
<script type="text/javascript">
	function print3()
	{
		var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
		newWindow.document.write(document.getElementById("printmbr").innerHTML);
		newWindow.print();

	}
</script>
<script type="text/javascript">
	function print4()
	{
		var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
		newWindow.document.write(document.getElementById("printorder").innerHTML);
		newWindow.print();

	}
</script>


<script>
	$("#simpandepositlgn").click(function()
		{



			id_cs=$("#id_cs").val();
			paket=$("#paket").val();
			hargapaket=$("#hargapaket").val();
			carabayarlgn=$("#carabayarlgn").val();
			jumlahpoin=$("#jumlahpoin").val();

			sisa_kuota= $("#sisa_kuota").val();
			c = parseInt(sisa_kuota)+ parseInt(hargapaket)
			$("#kuota_sekarang_tambah").val(c);
			kuota_sekarang_tambah=$("#kuota_sekarang_tambah").val();

			a =$("#kali").val();
			b = Math.floor( hargapaket * a);
			$("#tambahpoin").val(b);
			poin= $("#tambahpoin").val();
			c = parseInt(jumlahpoin)+ parseInt(poin)
			$("#totalpoin").val(c);
			totalpoin= $("#totalpoin").val();


			if ( paket == "" )
			{
				alert("Pilih Paket");
				$("#paket").focus();
				return false;
			}
			if ( hargapaket == "" )
			{
				alert("harga Paket masih kosong");
				$("#hargapaket").focus();
				return false;
			}



			$.ajax(
				{
					url:"input_dp_lgn.php",
					data:"id_cs="+id_cs+"&hargapaket="+hargapaket+"&paket="+paket+"&carabayarlgn="+carabayarlgn+"&kuota_sekarang_tambah="+kuota_sekarang_tambah+"&totalpoin="+totalpoin+"&poin="+poin,

					success:function(msg)
					{
						$("#printdp").html(msg);
						$("#paket").val("");
						$("#hargapaket").val("");
						$("#customer").load("pk_customer.php","op=customerspk&id_cs="+id_cs);
						$("#rincian").load("pk_customer.php","op=rincian_penjualan&id_cs="+id_cs+"&no_nota="+no_nota);
						$("#rincianorder").load("rincian_order.php","id_cs="+id_cs);
						$("#piutang").load("pk_customer.php","op=piutang&id_cs="+id_cs);
						$("#modal-langganan").modal('hide');
					}
				})
		})

</script>
<script>
	$("#jdlgn").click(function()
		{
			if (confirm("Yakin jadikan Langganan?"))
			{
				var id_cs=$("#id_cs").val();
				var data = "id_cs=" + id_cs ;
				$.ajax(
					{
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

		})



</script>

<script>

	$("#simpanmember").click(function()
		{



			id_cs=$("#id_cs").val();
			jenis_member=$("#jenis_member").val();
			hargamember=$("#hargamember").val();
			tgl_akhir=$("#tgl_akhir").val();
			carabayarmbr=$("#carabayarmbr").val();



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
					url:"input_bayar_member.php",
					data:"id_cs="+id_cs+"&hargamember="+hargamember+"&jenis_member="+jenis_member+"&carabayarmbr="+carabayarmbr+"&tgl_akhir="+tgl_akhir,

					success:function(msg)
					{
						$("#printmbr").html(msg);
						$("#jenis_member").val("");
						$("#hargamember").val("");
						$("#customer").load("pk_customer.php","op=customerspk&id_cs="+id_cs);
						$("#rincian").load("pk_customer.php","op=rincian_penjualan&id_cs="+id_cs+"&no_nota="+no_nota);
						$("#rincianorder").load("rincian_order.php","id_cs="+id_cs+"&no_nota="+no_nota);
						$("#piutang").load("pk_customer.php","op=piutang&id_cs="+id_cs);
						$("#modal-member").modal('hide');
					}
				})
		})



</script>
<script>
	$("#simpanordersementara").click(function()
		{
			id_item=$("#id_item").val();
			id_cs=$("#id_cs").val();
			jumlah=$("#jumlahitem").val();
			berat=$("#beratitem").val();
			itm=$("#itemklp").combobox('getValue');                       
                        
			jenis_item=$("#itemklp").combobox('getText')+" "+$("#ket1").val();
			if ( id_item == '186' )
			{
				harga= $("#hargalain").val();
			}else
			{
				harga= $("#hargaitem").val();
			}



			c = harga*jumlah;
			$("#total").val(c);
			total= $("#total").val();
			if ( jumlah == "" )
			{
				alert("Jumlah Masih Kosong");
				$("#jumlah").focus();
				return false;
			}else if ( itm == "" )
			{
				alert("Item belum ada");
				$('#itemklp').next().find('input').focus()
				return false;
			}else if ( harga == "" )
			{
				alert("harga masih kosong");
				$('#hargaitem').next().find('input').focus()
				return false;
			}



                        var hanger_own = $("#hanger_own").prop('checked');
                        var deliver = $("#deliver").prop('checked');
                        var parfum = $("#parfum:checked").val();
                        var charge =  $("#charge").combobox('getValue');
                        var hanger = $("#hanger").val();
                        var hanger_plastic = $("#hanger_plastic").val(); 


			$.ajax(
				{
					url:"pk_customer.php",
					data:"op=tambahdetailpenjualan&jumlah="+jumlah+"&total="+total+"&jenis_item="+jenis_item+"&id_cs="+id_cs+"&harga="+harga+"&berat="+berat+
                                                "&hanger_own="+hanger_own+"&deliver="+deliver+"&parfum="+parfum+"&charge="+charge+
                                                "&hanger="+hanger+"&hanger_plastic="+hanger_plastic,
					cache:false,
					success:function(msg)
					{
						$('#status').html(msg);
						$("#jumlah").val("1");
						$("#ket").val("");
						$("#piutang").load("pk_customer.php","op=piutang&id_cs="+id_cs);
						$("#customer").load("pk_customer.php","op=customer&id_cs="+id_cs);
						$('#status').hide();
						$("#modal-potongan").modal('hide');
						getorder();
						$('#dgorder').datagrid('reload');
						getrincianorder();
						$('#dgrincian').datagrid('reload');

						$('#hargaitem').textbox('clear');
						$('#itemklp').combobox('clear');

					}
				})
		})


</script>
<script>
	$("#paket").change(function()
		{

			var paket = $("#paket").val();

			if(paket=="kilo30")
			{
				$("#hargapaket").val("240000");

			}else if(paket=="singgle")
			{
				$("#hargapaket").val("360000");
			}else if(paket=="couple")
			{
				$("#hargapaket").val("420000");
			}



		});
</script>
<script>
	$("#jenis_member").change(function()
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



		});
</script>
<script>
	function getNextElement(field)
	{
		var form = field.form;
		for ( var e = 0; e < form.elements.length; e++)
		{
			if (field == form.elements[e])
			{
				break;
			}
		}
		return form.elements[++e % form.elements.length];
	}

	function tabOnEnter(field, evt)
	{
		if (evt.keyCode === 13)
		{
			if (evt.preventDefault)
			{
				evt.preventDefault();
			} else if (evt.stopPropagation)
			{
				evt.stopPropagation();
			} else
			{
				evt.returnValue = false;
			}
			getNextElement(field).focus();
			return false;
		} else
		{
			return true;
		}
	}


</script>
<script>
	$('#itemklp').combobox(
		{
			filter: function(q, row)
			{
				var opts = $(this).combobox('options');
				return row[opts.textField].toUpperCase().indexOf(q.toUpperCase()) >= 0;
			}

		});
</script>
<script>
	$('#itemklp').combobox(
		{
			validType:'inList["#itemklp"]'
		});
</script>
<script>
	$.extend($.fn.validatebox.defaults.rules,
		{
			inList:
			{
				validator:function(value,param)
				{
					var c = $(param[0]);
					var opts = c.combobox('options');
					var data = c.combobox('getData');
					var exists = false;
					for(var i=0; i<data.length; i++)
					{
						if (value == data[i][opts.textField])
						{
							exists = true;
							break;
						}
					}
					return exists;
				},
				message:'item tidak ada.'
			}
		})
</script>
<script type="text/javascript">
	var url;
	function hapusorder()
	{
		var row = $('#dgrincian').datagrid('getSelected');
		if (row)
		{
			$.messager.confirm('Confirm','Hapus rincian order?',function(r)
				{
					if (r)
					{
						$.post('del_detail_order.php',
							{
								id:row.id
							},function(result)
							{
								if (result.success)
								{
									$('#dgrincian').datagrid('reload');	// reload the user data

								} else
								{
									$.messager.show(
										{
											// show error message
											title: 'Error',
											msg: result.errorMsg
										});
								}
							},'json');
					}
				});
		}
	}
</script>
<script type="text/javascript">
	var url;
	function voidorder()
	{
		var row = $('#dgorder').datagrid('getSelected');
		if (row)
		{
			$.messager.confirm('Confirm','void order?',function(r)
				{
					if (r)
					{
						$.post('del_order.php',
							{
								no_nota:row.no_nota
							},function(result)
							{
								if (result.success)
								{
									$('#dgorder').datagrid('reload');	// reload the user data
									location.reload();
								} else
								{
									$.messager.show(
										{
											// show error message
											title: 'Error',
											msg: result.errorMsg
										});
								}
							},'json');
					}
				});
		}
	}
</script>
<script>
	$('#dgrincian').datagrid(
		{
			onLoadSuccess:function(data)
			{
				var data = $('#dgrincian').datagrid('getData');
				var rows = data.rows;
				var sum = 0;

				for (i=0; i < rows.length; i++)
				{
					sum+= parseInt( rows[i].total);
				}

				// just to show if the sum is OK
				$('#subtotalorder').val(sum);
				$('#totalorder').val(sum);
				$('#maintotal').val(sum);
		tottt=$("#subtotalorder").val();

/*
if (tottt<30000){
	$("#voucher").attr('readonly', 'readonly');
}else{
*/
	$("#voucher").removeAttr('readonly');
//}
			}
		})
</script>
<script>
	$("#voucher").blur(function()
		{
			var voucher=$("#voucher").val();
			var id_cust=$("#id_cust").val ();
                        var mbr=$('#mbr').val();
			$.ajax(
				{
					url:"pk_customer.php",
					data:"op=voucher&voucher="+voucher,
					success:function(msg)
					{
						data=msg.split("|");
						if(data[1]!=0 && data[2]=='ld' && $("#maintotal").val()>=30000 )
						{
							$("#pesan").html('voucher Bisa digunakan');
							a=data[0];
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[3] < 10 && data[2]=='RV' && data[4]!=id_cust && mbr!=1 && $("#maintotal").val()>=30000)
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0];
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='ALL' && data[4]=='ALL' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='<?php echo $ot; ?>' && data[4]=='ALL' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='<?php echo $ot; ?>' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='<?php echo $ot; ?>' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='ALL' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='ALL' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='ALL' && data[4]=='ALL' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='<?php echo $ot; ?>' && data[4]=='ALL' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='<?php echo $ot; ?>' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='<?php echo $ot; ?>' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='ALL' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='ALL' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled',''); 
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='ALL' && data[4]=='ALL' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='<?php echo $ot; ?>' && data[4]=='ALL' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='<?php echo $ot; ?>' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='<?php echo $ot; ?>' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='ALL' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='ALL' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
							
						}else 
						{
							$("#pesan").html('voucher tidak dapat di gunakan');
							$("#voucher").css('border','3px #c33 solid');
							$("#diskon").val('');							
							$("#totalorder").val(b);							
						}
					}
				});
		})
</script>