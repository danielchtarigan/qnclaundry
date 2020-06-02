<script type="text/javascript">
function add_sub(el)
{

  var cbs = document.getElementById('checkboxes').getElementsByTagName('input');
  var textareaValue = '';  
    var jumlah=0;
  for (var i = 0, len = cbs.length; i<len; i++) {
    if ( cbs[i].type === 'checkbox' && cbs[i].checked) {
          textareaValue += cbs[i].value + ' ';jumlah++;
    }
  }document.getElementById('jumlah').value=jumlah;
   document.getElementById('textarea').value = textareaValue;            
}
function handle(e){
  var cbs = document.getElementById('checkboxes').getElementsByTagName('input');
  var cr = document.getElementById('cari').value;
  var cek=0;
  if(e.keyCode === 13){
  for (var i = 0, len = cbs.length; i<len; i++) {
    if ( cbs[i].value ==cr) {
          cbs[i].checked=true;
          add_sub(this);
          cek=1;    
    }
    }
    if (cek==0) alert('No nota '+cr+' tidak ditemukan');
    document.getElementById('cari').value="";}
}
function validasi(){
  var dr = document.getElementById('textarea').value; 
  if (dr==null || dr=="") {
    alert("Minimal 1 Kode Serah");
    return false;
  };
}
function validasi2(){
  var jumlah = document.getElementById('jumlah').value; 
  var total = document.getElementById('total').value;
  if (jumlah!=total) {
    alert("Jumlah yang dicek harus sama dengan jumlah keseluruhan");
    return false;
  };
}
</script>
<h3>MANIFEST TERIMA WORKSHOP</h3>
<?php
//=================================================
if (isset($_POST['nota']) and isset($_POST['jumlah']) and isset($_POST['tipe']) and isset($_POST['driver'])) { //form simpan data manifest terima
	$nota=$_POST['nota'];//kode serah
	$jumlah=$_POST['jumlah'];
	$driver=$_POST['driver'];
  $tipe=$_POST['tipe'];
?>
<p><input type="text" class="form-control" name="cari" id="cari" onkeypress="handle(event)" placeholder="Scan No Nota di sini !" style="float:left;"></p>
<table width="100%">
  <tr><td width="50%">
    <div id="checkboxes">
  <?php
  $kode_serah = explode(" ",$nota);
  $i=0;
  	foreach($kode_serah as $key => $value){
  		if ($value!=''){
  	if ($tipe==1) {
  	$cekdata=mysqli_query($con,"SELECT * FROM manifest WHERE kd_serah='$value'");
  } else if ($tipe==2){
  	$cekdata=mysqli_query($con,"SELECT * FROM manifest WHERE kd_serah2='$value'");}
  	echo '<h4>'.$value.'</h4>';
  $ncek = mysqli_num_rows($cekdata);
  if ($ncek>0){
    while ($rcekdata = mysqli_fetch_array($cekdata)){
    $no = $rcekdata['no_nota'];$i++;
  ?>
  <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>" onchange="add_sub(this);"> <?=$no?><br>
  <?php
  }}}}
  ?>
</div>
  </td><td>
    <form onsubmit="return validasi2()" method="POST" action="?menu=am">
    <table width="100%">
    <tr><td>Jumlah yang dicek</td><td>:</td><td><input type="text" name="jumlah" id="jumlah" readonly value="0" ></td></tr>
    <tr><td>Jumlah Keseluruhan</td><td>:</td><td><input type="text" name="total" id="total" readonly value="<?=$i?>" ></td></tr>
    <tr><td>Penerima</td><td>:</td><td><input type="text" name="penerima" readonly value="<?=$user_id?>" ></td></tr>
    </table><br>
<textarea id="textarea" name="nota" rows="<?=$i?>" style="width=100%;" onclick="this.focus();this.select();" readonly required></textarea>
<br>
<input type="hidden" name="man" value="terima">
<input type="hidden" name="kd_serah" value="<?=$nota?>">
<input type="hidden" name="driver" value="<?=$driver?>">
<input type="hidden" name="tipe" value="<?=$tipe?>">
<input type="submit" value="Simpan">
</form>
  </td></tr>
</table>
<?php
}
//=================================================
else if (isset($_POST['driver']) and isset($_POST['tipe'])) {//form pilih data manifest serah
	$driver=$_POST['driver'];
  $tipe=$_POST['tipe'];
?>
<p><input type="text" class="form-control" name="cari" id="cari" onkeypress="handle(event)" placeholder="Scan Kode Manifest Terima Workshop di sini !" style="width:50%;float:left;"></p>
<table width="100%" >
  <tr><td width="50%">
    <div id="checkboxes">
  <?php
    $cekdata = mysqli_query($con, "select * from man_serah where driver='$driver' and tipe=$tipe and kode_terima=''");
  $ncek = mysqli_num_rows($cekdata);
  if ($ncek>0){
    $i=0;
    while ($rcekdata = mysqli_fetch_array($cekdata)){
    $no = $rcekdata['kode_serah'];$i++;
  ?>
  <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>" onchange="add_sub(this);"> <?=$no?><br>
  <?php
  }}
  ?>
</div>
  </td><td>
    <form onsubmit="return validasi()" method="POST" action="">
    <table width="100%">
    <tr><td>Driver</td><td>:</td><td><input type="text" name="driver" readonly value="<?=$driver?>" ></td>
    <tr><td>Jumlah</td><td>:</td><td><input type="text" name="jumlah" id="jumlah" readonly value="0" ></td>
    </tr></table><br>
<textarea id="textarea" name="nota" rows="<?=$ncek?>" style="width=100%;" onclick="this.focus();this.select();" readonly required></textarea>
<br>
<input type="hidden" name="tipe" value="<?=$tipe?>">
<input type="submit" value="Lanjut">
</form>
  </td></tr>
</table>
<?php
} 
//=================================================
else { //cari data antaran driver
?>
<form method="POST" action="">
    <div>                                       
        <input type="text" name="driver" class="form-control" placeholder="Masukkan Nama Driver Disini.." style="width:50%; float:left;" required/>      											
        <br><br>
        <input type="hidden" name="tipe" value="1">
        <input type="submit" class="btn btn-success btkiloan" value="CARI" style="width:20%; background-color:#FFF; color:#6C0;"/>
    </div>
</form>	<br><br>
<?php 
include 'd_mterima.php';
} ?>