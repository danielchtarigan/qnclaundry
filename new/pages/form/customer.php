
<div class="panel panel-default">

    <div class="widget-body">
        <div class="widget-main">

            <div class="row">
                <form class="form-inline col-md-6 col-xs-12 col-sm-6" role="form" action="">
                    <div class="form-group input-group">
                        <input class="form-control" type="text" id="key" name="key" placeholder="Cari di sini ...">
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-sm" type="submit" id="cari" name="cari"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </span>
                    </form>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6" align="right">
                    <a class="btn btn-white btn-default btn-sm btn-tambah" data-toggle="modal" href="#modal-form">Tambah Baru</a>
                </div>
            </div>

            <div id="modal-form" class="modal" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="blue bigger">Form Customer Baru</h4>
                        </div>

                        <div class="modal-body">
                            <form role ="form">
                                <div id="d"></div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input class="form-control" type="text" id="telp" name="telepon" placeholder="No Telepon" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Nama Customer</label>
                                    <input class="form-control" id="nama" name="nama" placeholder="Nama Customer" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" id="alamat" name="alamat" placeholder="Alamat" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Tau QuicknClean dari?</label>
                                    <select class="form-control" name="info_qnc" id="info_qnc">
                                        <option value="">--</option>
                                        <option value="Brosur">Brosur</option>
                                        <option value="Spanduk">Spanduk</option>
                                        <option value="Teman">Teman</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No. Telepon Referensi</label>
                                    <input class="form-control" name="referensi" id="referensi" placeholder="No Telepon Referensi" disabled="">
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>

                            <button class="btn btn-sm btn-primary btn-simpan">
                                <i class="ace-icon fa fa-check"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- PAGE CONTENT ENDS -->


                
            <br>

            <br>
            <div class="table-responsive">
                <table class="table table-condensed table-bordered table-striped" id="cust">
                    <thead>
                        <tr>
                            <th width="25%">Nama</th>
                            <th width="35%">Alamat</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th width="8%">Proses</th>
                        </tr>
                    </thead>
                    <tbody id="customer">
                        <tr>
                            <th colspan="5">..Data tidak ada..</th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


            


<script type="text/javascript">
    $("#cari").on('click', function(e){
        e.preventDefault();
        var key = $("#key").val();
        $.ajax({
            url     : 'include/customer.php',
            data    : 'key='+key,
            success : function(data){
                $("#customer").html(data);
            }
        })
    });

    $("#info_qnc").change(function(){
        var info = $(this).val();
        
        if(info=="Teman"){
            $("#referensi").prop('disabled', false);
        } else {
            $("#referensi").prop('disabled', true);
        }
    });


    $("#telp").keypress(function(e){       
        var telp = $(this).val();     
        var panj = telp.length;
        if(panj>11) {
            $("#d").html("Maksimal 12 Karakter").fade(fast); 
            return false;
        } 
        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
            $("#d").html("Isikan Angka");
             return false;
        } 
    });

    $("#telp").focusout(function(){
        var telp = $(this).val();
        $.ajax({
            url     : 'action/valid_phone.php',
            data    : 'telp='+telp,
            success : function(data) {
                if(data==0){
                    $("#d").html("Nomor telp sudah pernah terdaftar..!").css('color', 'red');;
                } else {
                    $("#d").html("Nomor telp benar, silahkan lanjutkan..!").css('color', 'green');
                }
            }
        })
    });

    $(".btn-simpan").on('click',function(e){
        e.preventDefault();
        var telepon = $("#telp").val();
        var nama = $("#nama").val();
        var alamat = $("#alamat").val();
        var info = $("#info_qnc").val();
        var referensi = $("#referensi").val();
        if(telepon=='' || nama=='' || alamat=='' || info=='') {
            $("#d").html('Isian tidak boleh kosong!!');
        } else {
            $.ajax({
                url     : 'action/tambah_customer.php',
                data    : 'telepon='+telepon+'&nama='+nama+'&alamat='+alamat+'&info='+info+'&referensi='+referensi,
                type    : 'POST',
                success : function(data){
                    $("#d").html(data);
                }
            })
        };
            
    })

</script>


<style type="text/css">
    #cust tr th, .cust {
        text-align: center;
    }
</style>

