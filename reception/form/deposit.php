                                <div class="modal-header">
                                        Deposit Langganan
                                </div>
                                <div class="modal-body">
                                        <form method="post" action="" id="form-input1" class="form-horizontal">

                                                <fieldset>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="paket">
                                                                        Pilih Paket
                                                                </label>
                                                                <div class="col-xs-6" >
                                                                        <select class="form-control" name="paket" id="paket">
                                                                                <option value="">
                                                                                        --
                                                                                </option>
                                                                                <option value="kilo30">
                                                                                        All Kiloan 30kg
                                                                                </option>
                                                                                <option value="single">
                                                                                        Paket Singglet
                                                                                </option>
                                                                                <option value="family">
                                                                                        Paket Couple
                                                                                </option>
                                                                                <option value="professional">
                                                                                        Paket Couple
                                                                                </option>
                                                                                <option value="custom">
                                                                                        Custom
                                                                                </option>
                                                                        </select>
                                                                </div><br>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="hargapaket" class="control-label col-xs-3">
                                                                        Harga Paket
                                                                </label>
                                                                <div class="col-xs-4" >
                                                                        <input type="text" class="form-control" autocomplete="off" name="hargapaket" id="hargapaket" />
                                                                </div><br>
                                                        </div>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="carabayarlgn">
                                                                        Cara Bayar
                                                                </label>
                                                                <div class="col-xs-4" >
                                                                        <select class="form-control" name="carabayarlgn" id="carabayarlgn">
                                                                                <option value="cash">
                                                                                        Cash
                                                                                </option>
                                                                                <option value="edcbca">
                                                                                        Edc BCA
                                                                                </option>
                                                                                <option value="edcmandiri">
                                                                                        Edc Mandiri
                                                                                </option>
                                                                                <option value="edcbri">
                                                                                        Edc BRI
                                                                                </option>
                                                                        </select>
                                                                </div><br>
                                                        </div>

                                                </fieldset>




                                        </form>
                                </div>
                                <div class="modal-footer">
                                        <button id="simpandepositlgn" class="btn btn-md btn-success">
                                                Simpan
                                        </button>
                                        <button class="btn btn-default" data-dismiss="modal">
                                                <i class="fa fa-close">
                                                </i>Batal
                                        </button>
                                </div>
                                
<script>
	$("#paket").change(function()
		{

			var paket = $("#paket").val();

			if(paket=="kilo30")
			{
				$("#hargapaket").val("264000");

			}else if(paket=="single")
			{
				$("#hargapaket").val("275000");
			}else if(paket==family")
			{
				$("#hargapaket").val("715000");
			}else if(paket=="professional")
			{
				$("#hargapaket").val("465000");
			}



		});
</script>
                                