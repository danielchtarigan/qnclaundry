<?php
//Koneksi database
include '../config.php';
session_start();
$cari = $_GET['cari'];

$qry = "SELECT * FROM detail_hotel WHERE no_nota='$cari'";
$tmp = mysqli_query($con, $qry);
$row = mysqli_fetch_array($tmp);
?>

<div  class="container-fluid" style="width:850px;
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
    <legend align="center"><strong>Packer Hotel</strong>
    </legend>
    
    <form method="post" action="savepacker_hotel.php" id="formlist" class="form-horizontal">
     
     <div class="form-group ">
    <label class="control-label col-xs-3" for="hp4">
    No Nota</label>
    <div class="col-xs-4">
    <input type="text" readonly="true" class="form-control" autocomplete="off" name="no_nota" id="no_nota" required="false" value="<?php echo $row['no_nota']; ?>">
    <input type="hidden" readonly="readonly" class="form-control" autocomplete="off" name="nama_hotel" id="nama_hotel" required="false" value="<?php echo $row['nama_hotel']; ?>" />
    </div>
	</div>
<div class="form-group ">
        <label class="control-label col-xs-3" for="hp4">
    Berat</label>
    <div class="col-xs-4">
    <input type="text" class="form-control" autocomplete="off" name="berat" id="berat" required="true">
    </div>
	</div>
     
     
      <div>
        <table id="rincianspk" class="display">
          <thead>
            <tr>
              <th>id</th>
              <th>no_nota</th>
              <th>jenis_item</th>
              <th>SPK</th>
              <th>keterangan</th>
              <th>packer</th>
            </tr>
          </thead>
          <tbody>
            <?php
$query = "SELECT * FROM detail_hotel WHERE no_nota='$cari'";
$tampil = mysqli_query($con, $query);
while($data = mysqli_fetch_array($tampil)){
?>
            <tr>
              <td><?php echo $data['id'];?></td>
              <td><?php echo $data['no_nota'];?></td>
              <td><?php echo $data['item'];?></td>
              <td><?php echo $data['jumlah'];?></td>
              <td><?php echo $data['ket'];?></td>
              <td><span class="col-xs-6">
              	<input type="hidden" id="id" name="id[]" value="<?php echo $data['id']; ?>">
                <input type="number" class="easyui-textbox" name="packer[]" required="true" />
              </span></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <legend></legend>
      <div align="center">
        <input class="btn btn-danger" name="submit" type="submit" value="simpan" />
      </div>
    </form>
  </fieldset>
</div>
<script type="text/javascript">
$(document).ready(function(){
 $('#rincianspk').dataTable({
	  			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
	  			 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 10
				
			})
	    	});
	</script>