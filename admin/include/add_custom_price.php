<form class="form-horizontal form-style-x" action="" id="custom_price">
    <div class="form-group">
        <div class="checkbox">
            <label for="active" style="font-weight: bold">
                <input type="checkbox" id="active" checked="true"> Active
            </label>
        </div>
    </div>
    <div class="form-group" hidden>
        <label for="id" class="col-md-2 control-label">ID</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="id" id="id" autocomplete="off" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-md-2 control-label">Barang</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Ketik nama barang" autocomplete="off" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="price1" class="col-md-2 control-label">Harga</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="price[1]" id="price1" placeholder="0" value="" autocomplete="off">
        </div>
        <label for="max1" class="col-md-2 control-label">Max Qty</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="max[1]" id="max1" placeholder="1" value="3" autocomplete="off">
        </div>
    </div>
    <div class="form-group">
        <label for="price2" class="col-md-2 control-label">Harga</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="price[2]" id="price2" placeholder="0" value="" autocomplete="off">
        </div>
        <label for="max2" class="col-md-2 control-label">Max Qty</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="max[2]" id="max2" placeholder="1" value="6" autocomplete="off">
        </div>
    </div>
</form>

<style>
    .form-style-x {
        padding: 0 15px;
    }
</style>

