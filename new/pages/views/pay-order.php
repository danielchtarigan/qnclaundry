<div id="myform">
    <div class="laundry-package show">
        <div class="table-overlays">
            <ul class="list-group invoice-customer" style="width: 100%">
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">Informasi Pembayaran</h4>
                    <div class="list-group-item-body">
                        <div class="info-heading">
                            <table>
                                <tr>
                                    <td>ID Pelanggan</td>
                                    <td>:</td>
                                    <td id="customerId"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Tagihan</td>
                                    <td>:</td>
                                    <td id="invoiceValue"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </li>
                <li class="list-group-item payment-method">
                    <h4 class="list-group-item-heading">Metode Pembayaran</h4>
                    <div class="list-group-item-body">
                        <div class="list-choose-method">
                            <h4 class="title-method">Dengan Cash</h4>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="cash"><label for="cash">Cash</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_cash" disabled="true" value="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="list-choose-method">
                            <h4 class="title-method">Dengan EDC</h4>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="edcbca"><label for="edcbca"> EDC BCA</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_edcbca" disabled="true" value="0" autocomplete="off">
                            </div>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="edcbri"><label for="edcbri"> EDC BRI</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_edcbri" disabled="true" value="0" autocomplete="off">
                            </div>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="edcbni"><label for="edcbni"> EDC BNI</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_edcbni" disabled="true" value="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="list-choose-method" id="paymentLangganan">
                            <h4 class="title-method">Dengan Kuota</h4>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="kuota_kiloan"><label for="kuota_kiloan"> Kiloan</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_kuota_kiloan" disabled="true" value="0" readonly autocomplete="off">
                            </div>
                            <div class="select-input-item" style="display: none;">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="kuota_potongan"><label for="kuota_potongan"> Potongan</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_kuota_potongan" disabled="true" autocomplete="off">
                            </div>
                            <small style="margin-top: 15px; display: block">Cat: Dengan memilih kuota, maka akan otomatis mengurangi kuota sekarang</small>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="f-horizontal" style="flex-direction: column">
            <div style="display: flex; justify-content: space-between; margin-top: 10px">
                <b id="labelPrice">Total Bayar</b><span id="totalPay">Rp 0</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px">
                <span id="labelPrice">Selisih Bayar</span><span id="differentPayment">Rp 0</span>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="savePayOrder"> <i class="ace-icon fa fa-save"></i> Bayar</button>
    </div>
</div>

<style lang="css">
    .list-group-item-body {
        margin-top: 14px;
    }

    .list-group-item-body>.info-heading>table {
        width: 100%;
    }

    .list-group-item-body>.info-heading>table td {
        line-height: 2;
    }

    .select-input-item,
    .select-item-h {
        display: flex;
        flex-direction: row;
    }

    .select-item-h {
        align-items: center;
        width: 50%;
    }

    .select-item-h label,
    .select-item-h input[type=checkbox] {
        margin: 0;
    }

    .select-item-h label {
        margin-left: 10px;
        width: 100%;
        cursor: pointer;
    }

    .title-method {
        font-size: 14px;
        font-weight: bold;
        color: seagreen;
    }

    .list-group-item-body .list-choose-method {
        /* background-color: salmon; */
    }

    .list-group-item-body .list-choose-method>.title-method {
        border-bottom: 1px solid #ddd;
        padding: 6px 0;
    }
    
</style>


<script src="views/sales/salesPayment.js"></script>