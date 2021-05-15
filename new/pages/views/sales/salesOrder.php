<div id="myform" class="create-order new-order">   

    <div class="choose-item sales-category show" id="salesCategory">
        <div class="overlay">
            <h2 class="title">Pilih Kategori Penjualan</h2>
            <div class="table-overlays">
                <div class="list-package">
                    <div class="list-group" id="selectItem">
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading" id="name">Laundry Kiloan</h4>
                            <p class="list-group-item-text">
                                <b id="value" data-value="1">Cucian dihitung per kilogram</b>
                            </p>
                        </a>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading" id="name">Laundry Potongan</h4>
                            <p class="list-group-item-text">
                            <b id="value" data-value="2">Cucian dihitung per lembar</b>
                            </p>
                        </a>
                        <!-- <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading" id="name">Laundry Linen</h4>
                            <p class="list-group-item-text">
                            <b id="value" data-value="3">Cucian dihitung per lembar setelah ditimbang</b>
                            </p>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>              
        <button type="button" class="btn btn-primary nextstep" id="nextstep" disabled><i class="ace-icon fa fa-arrow-circle-right"></i> Berikutnya</button>
    </div>

</div>

<style>
    .text-red {
        color: red;
    }

    /* .f-horizontal.column {
        flex-direction: column;
    } */
    .f-horizontal {
        padding: 15px 0;
    }

    .flex-row {
        display: flex;
        justify-content: space-between;
    }
</style>