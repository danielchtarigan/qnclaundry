<script type="text/javascript">
function cek(){
        if (document.form3.info.value=='Teman'){
	document.form3.referensi.readOnly = false;
        } 
}
</script>
<form action="act/add-customer.php" method="GET" name="form3" id="form3">
                                        <div class="form-group">
                                            <label>No Telepon</label>
                                            <input class="form-control" name="telepon" placeholder="No Telepon" required="required" autocomplete="off">
                                            <span id="d"></span>
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
                                            <select class="form-control" name="info" id="info_dari" onchange="cek()">
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

<script type="text/javascript">
    $("input[name=telepon]").keypress(function(e){       
        var telp = $(this).val();     
        var panj = telp.length;
        if(panj>11) {
            $("#d").text("* Maksimal 12 Karakter").fadeIn('fast');
            $('input[name=telepon]').val("");
            return false;
        } 
        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
            $("#d").text("* Isikan Angka");
            $('input[name=telepon]').val("");
            return false;
        } 
    });
</script>