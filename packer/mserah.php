<?php 
include "../config.php"; 
include "header.php";
$workshop=$_SESSION['workshop'];
?>
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
    alert("Minimal 1 No Nota");
    return false;
  };
}
</script>
<div  class="container-fluid" style="width:1200px;
   margin:0 auto; 
   position:relative; 
   border:3px solid rgba(0,0,0,0); 
   -webkit-border-radius:5px; 
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
 <fieldset>
 <?php 
 if (isset($_POST['ot'])) {
  $ot=$_POST['ot'];
 ?>
<h3 align="center">MANIFEST SERAH OUTLET</h3>
<p><input type="text" class="form-control" name="cari" id="cari" onkeypress="handle(event)" placeholder="Scan No Nota di sini !"></p>
<table width="100%">
  <tr><td width="50%">
    <div id="checkboxes">
  <?php
  $cekdata = mysqli_query($con, "select * from manifest a,reception b where a.no_nota=b.no_nota and nama_outlet='$ot' and spk=1 and packing=1 and kembali=0 and rijeck=0");
  $ncek = mysqli_num_rows($cekdata);
  if ($ncek>0){
    $i=0;
    while ($rcekdata = mysqli_fetch_array($cekdata)){
    $no = $rcekdata['no_nota'];$i++;
  ?>
  <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>" onchange="add_sub(this);"> <?=$no?><br>
  <?php
  }}
  ?>
</div>
  </td><td>
    <form onsubmit="return validasi()" method="POST" action="act_manifest.php">
    <table width="100%">
    <tr><td>Driver</td><td>:</td><td><input type="text" name="driver" id="driver" required></td>
    <tr><td>Jumlah</td><td>:</td><td><input type="text" name="jumlah" id="jumlah" readonly value="0" ></td>
    </tr></table><br>
<textarea id="textarea" name="type" rows="<?=$ncek?>" style="width=100%;" onclick="this.focus();this.select();" readonly required></textarea>
<br>
<input type="hidden" name="ot" value="<?=$ot?>">
<input type="hidden" name="man" value="serah">
<input type="submit" value="Simpan">
</form>
  </td></tr>
</table>
<?php
}
else{
  ?>
  <h3>MANIFEST SERAH OUTLET</h3>
<form method="POST" action="">
    <div>   
      <select name="ot" class="form-control" style="width:50%; float:left;">
      <?php
  $cekdata = mysqli_query($con, "select nama_outlet from outlet WHERE Kota='Makassar'");
  $ncek = mysqli_num_rows($cekdata);
  if ($ncek>0){
    while ($rcekdata = mysqli_fetch_array($cekdata)){
    $ot = $rcekdata['nama_outlet'];
  ?>
      <option value="<?=$ot?>">Outlet <?=$ot?></option>
      <?php } }
      ?>
      </select><br><br>                                     
        <input type="submit" class="btn btn-success btkiloan" value="CARI" style="width:20%; background-color:#FFF; color:#6C0;"/>
    </div>
</form> 

<?php
include 'd_mserah.php';
} ?>
</fieldset>
</div>
