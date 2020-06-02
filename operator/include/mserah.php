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
<h3 align="center">MANIFEST TRANSFER KELUAR</h3>
<p><input type="text" class="form-control" name="cari" id="cari" onkeypress="handle(event)" placeholder="Scan No Nota di sini !"></p>
<table width="100%">
  <tr><td width="50%">
    <div id="checkboxes">
  <?php
  $cekdata = mysqli_query($con, "select * from manifest a,reception b, control c where a.no_nota=b.no_nota and b.nama_outlet=c.nama_outlet and ws_setrika<>'' and spk=1 and pengering=1 and setrika=0 and rijeck=0");
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
    <form onsubmit="return validasi()" method="POST" action="?menu=am">
    <table width="100%">
    <tr><td>Driver</td><td>:</td><td><input type="text" name="driver" id="driver" required></td>
    <tr><td>Jumlah</td><td>:</td><td><input type="text" name="jumlah" id="jumlah" readonly value="0" ></td>
    </tr></table><br>
<textarea id="textarea" name="type" rows="<?=$ncek?>" style="width=100%;" onclick="this.focus();this.select();" readonly required></textarea>
<br>
<input type="hidden" name="man" value="serah">
<input type="submit" value="Simpan">
</form>
  </td></tr>
</table>