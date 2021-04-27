<div class="choose-item preview-order show" id="salesOrderDetail">
    <div class="overlay" style="height: 100%; padding-bottom: 25px;">
        <h2 class="title">Rincian Pesanan</h2>
        <div class="overlay-content" id="showOrder">
            <div class="detail-order">
                <div class="detail-heading">
                </div>
                <div class="detail-body">
                    <table width="80%" class="table-detail-item"></table>
                    <div class="clearfix"></div>
                </div>
                <div class="detail-footer">
                    <table width="60%" class="table-detail-item">
                        <tr>
                            <td>Sub Total</td>
                            <td>:</td>
                            <td align="right" id="subTotal" data-value="0">0</td>
                        </tr>
                        <tr>
                            <td>Diskon Promo</td>
                            <td>:</td>
                            <td align="right" id="discount" data-value="0">0</td>
                        </tr>
                    </table>
                    <table width="60%" class="table-detail-item other-sale">
                    </table>
                    <div class="clearfix"></div>
                </div>
                <div class="btn btn-success btn-lg total">
                    <span>Total: </span><span id="totalOrder" data-value="0"></span>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="btn-group btn-group-justified" role="group" id="btnOrder">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary" id="saveOrder">Simpan</button>
        </div>
    </div>
</div>