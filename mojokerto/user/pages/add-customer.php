<?php
include 'header.php';
?>
       
        <div class="row">
             <div class="col-lg-12">
                <div class="panel panel-default">
                     <div class="panel-body">

<script type="text/javascript">
function cek(){
        if (document.form3.info.value=='Teman'){
	document.form3.referensi.readOnly = false;
        } 
}
</script>
<form action="save-customer.php" method="GET" name="form3" id="form3">
                                        <div class="form-group">
                                            <label>No Telepon</label>
                                            <input class="form-control" name="telepon" placeholder="No Telepon" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Customer</label>
                                            <input class="form-control" name="nama" placeholder="Nama Customer" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input class="form-control" name="alamat" placeholder="Alamat" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Tau QuicknClean dari?</label>
                                            <select class="form-control" name="info" id="info" onchange="cek()">
                                                <option value="">--</option>
                                                <option value="Brosur">Brosur</option>
                                                <option value="Spanduk">Spanduk</option>
                                                <option value="Teman">Teman</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No. Telepon Referensi</label>
                                            <input class="form-control" name="referensi" id="referensi" placeholder="No Telepon Referensi" readonly="readonly">
                                        </div>
                                        <div class="form-group">
<input type="submit" class="btn btn-success btpotongan" value="Simpan" style="width:100%; background-color:#6C0;"/>                                        </div>
</form>
</div>
                   
                </div>                
            </div>          
        </div>
        

    