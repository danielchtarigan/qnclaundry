<form class="form-horizontal form-style-x" action="" id="form_goods">
    <div class="form-group">
        <label for="branch">Cabang</label>
        <select class="form-control" name="branch" id="branch" placeholder="Pilih cabang">
        </select>
    </div>
    <div class="form-group">
        <label for="outlet">Outlet</label>
        <select class="form-control" name="outlet" id="outlet" placeholder="Pilih outlet">
        </select>
    </div>
    <div class="form-group">
        <label for="category">Kategori Barang</label>
        <select class="form-control" name="category" id="category" placeholder="--Pilih kategori barang--">
        </select>
    </div>
    <div class="form-group" hidden>
        <label for="goods_id">Id Barang</label>
        <input type="text" class="form-control" name="goods_id" id="goods_id" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="name">Nama Barang</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Ketik nama barang" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="unit" class="col-md-2 control-label">Satuan</label>
        <select class="form-control" id="unit" name="unit">
            <option value="kg">kg</option>
            <option value="pcs">pcs</option>
            <option value="m">m</option>
        </select>
    </div>
    <div class="form-group">
        <label for="price">Harga Satuan</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="0" value="0" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="gramasi">Gramasi (gr)</label>
        <input type="text" class="form-control" name="gramasi" id="gramasi" placeholder="0" value="0" autocomplete="off">
    </div>
</form>

<style>
    .form-style-x {
        padding: 0 15px;
    }
</style>

<script>
    jQuery(function ($) {
        $("#name").keyup(function (e) {  
            let val = $(this).val();
            let newVal = toFirstWorlds(val);

            $(this).val(newVal);

        });

        function toFirstWorlds(str) {
            return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
        }
    });
</script>
