<html>
<?php
//Koneksi database
include 'header.php';
include '../config.php';

//$no_nota = $_GET['nama_cs'];
$not   = $_GET['id'];
//if( !empty ( $no_nota ) ){
//Query sql untuk mencari data
$sql = mysqli_query($con,"SELECT * From reception where no_nota='$not'");
//Cek apakah data ditemukan
$row = mysqli_num_rows( $sql );
//Jika ditemukan maka tampilkan
if( $row != 0 ){
	while( $data = mysqli_fetch_assoc( $sql ) )
	{
?>

<script>


	$(document).ready(function()
		{
				

			$('.btkiloan').click(function()
				{
					
					$('#jenis').val('k');
					$('#itemklp').combobox('reload', 'get_itemkiloan.php');

				});

			$('.btpotongan').click(function()
				{
					$('#jenis').val('p');
					$('#itemklp').combobox('reload', 'get_itempotongan.php')
				});
		});
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
<script type="text/javascript">
	$(document).ready(function(){
	$('#cuci').dataTable({
			
	"aaSorting": [[ 0, "desc" ]],
	"bJQueryUI" : true,
	"sPaginationType" : "full_numbers",
	"iDisplayLength": 10,
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
				
			}).yadcf([
	    ]);
	    });
</script>



<link rel="stylesheet" type="text/css" href="../lib/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="../lib/themes/icon.css" />
<script type="text/javascript" src="../lib/js/jquery.easyui.min.js">
</script>

<head>
</head>
<body>

<div class="container-fluid" style="width:500px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:80px; color:#000000;">

<fieldset>

<legend align="center"><h2>Lanjutkan Proses Reject
</h2></legend>
<form method="post" action="" id="form-input" class="form-horizontal">
  <div id="pesan_kirim" style="display:none">
  </div>
  
  <div class="form-group">
      <div class="col-xs-4">
      <input type="hidden" class="form-control" name="id_customer" id="id_customer" required="true" value="<?php echo $data['id']; ?>" readonly="true" />
      </div>
  </div>
  <div class="form-group" >
      <label class="control-label col-xs-3" for="nama_customer">
        No Nota
      </label>
      <div class="col-xs-4">
        <input type="text" class="form-control" name="no_nota" id="no_nota" required="true" value="<?php echo $data['no_nota']; ?>" readonly="true" >
      </div>
  </div>
  <div class="form-group" >
      <label class="control-label col-xs-3" for="nama_customer">
        Alamat
      </label>
      <div class="col-xs-4">
      <input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" >
      <input type="hidden" class="form-control" name="hargalama" id="hargalama" required="true" value="<?php echo $data['total_bayar']; ?>" readonly="true" >
      </div>
  </div>
  <div class="form-group" >
    <label class="control-label col-xs-3" for="nama_customer2"> Berat </label>
    <div class="col-xs-4">
      <input type="text" class="form-control" name="beratlama" id="beratlama" required="true" value="<?php echo $data['berat']; ?>" readonly="true" >
    </div>
  </div>
  <span class="calendar-header">
	  <input type="button" class="btn btn-info btkiloan" value="kiloan"/>
				<input type="button" class="btn btn-danger btpotongan" value="Potongan"/>
	<br />
    <br />
  
    <div class="form-group">
    <label class="control-label col-xs-3" for="kiloan"> Item </label>
    <div class="col-xs-4" >
      <input required="true" name="itemklp" id="itemklp" class="easyui-combobox"
						name="language"
						data-options="
							valueField:'id',
							textField:'nama_item',
							panelHeight:'auto',
							onSelect: function(rec)
                        {
						$('#beratitem').textbox('setValue', rec.berat);
						$('#hargaitem').textbox('setValue', rec.harga);
                        a=$('#hargaitem').val();
                        b=$('#hargalama').val();
                        c= parseInt(b)- parseInt(a)
                        $('#selisih').val(c);
                        }
                        
						">
    </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-4" for="jenis"> JenisCucian </label>
    <div class="col-xs-6" >
      <input type="text" class="form-control" name="jenis" id="jenis" required="true" />
    </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="hargaitem"> Harga </label>
    <div class="col-xs-6" >
      <input type="number" class="easyui-textbox" name="hargaitem" id="hargaitem" required="true" />
    </div>
    <br>
  </div>
  
  <legend></legend>
  <div align="center" class="form-group">
    <input type="button" value="Simpan" name="addvocher" id="addvocher" onClick="kirim_form()" class="btn btn-primary" />
  </div>
</form>
</fieldset>
</div>

<div class="container" style="width:700px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:20px; color:#000000;">
  <fieldset>
  <legend align="center"><strong>Data Barang Reject</strong></legend>
  
  <form method="post" action="nota_reject.php" id="formlist" class="form-horizontal">
  <span class="col-xs-4">
  <input type="hidden" class="form-control" name="no_nota2" id="no_nota2" required="true" value="<?php echo $data['no_nota'];?>" readonly="true" >
  <span class="col-xs-6">
  <input type="hidden" name="selisih" id="selisih" required="true" />
  <input type="hidden" class="form-control" name="nama_customer2" id="nama_customer2" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" >
  <input type="hidden" class="form-control" name="id_customer2" id="id_customer2" required="true" value="<?php echo $data['id']; ?>" readonly="true" />
  <input type="hidden" readonly="true" class="easyui-textbox" name="beratitem" id="beratitem" required="true" />
  </span></span>
    <div>
    <table id="cuci" class="display">
      <thead>
        <tr>
          <!--<th>id</th>-->
          <th>no_nota</th>
          <th>jenis_item</th>
          <th>jumlah</th>
          <th>keterangan</th>
          <th>select</th>
        </tr>
      </thead>
      <tbody>
<?php
$query = "SELECT * FROM detail_spk WHERE no_nota='$not' and status=false ";
$tampil = mysqli_query($con, $query);
while($data = mysqli_fetch_array($tampil)){
?>
        <tr>
          <!--<td><?php echo $data['id'];?></td>-->
          <td><?php echo $data['no_nota'];?></td>
          <td><?php echo $data['jenis_item'];?></td>
          <td><?php echo $data['jumlah'];?></td>
          <td><?php echo $data['ket'];?></td>
          <td>
          <input type="checkbox" name="reject[]" id="reject[]" value="<?php echo $data['id'];?>">
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
      </div>
    <legend></legend>
    <div align="center">
      <input class="btn btn-danger" name="submit" type="submit" value="simpan">
      </div>
    </form>
  </fieldset>
</div>
<?php
	}}
?>

</body>
</html>
