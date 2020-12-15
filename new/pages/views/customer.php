<div class="row" style="margin-bottom: 6px">
    <div class="col-md-6">
        <button class="btn btn-primary btn-sm" id="addCustomer">Tambah</button>
    </div>
</div>
<div class="table-responsive">
    <table id="dcustomer" class="table table-hover table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nama Customer</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<div id="dialog-form" title="Pelanggan Baru">
    <p class="validateTips"></p>        
    <form>
        <fieldset>
            <label for="telp">No Telepon</label>
            <input type="text" name="telp" id="telp" value="" placeholder="No Telepon" class="text ui-widget-content ui-corner-all">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="" placeholder="Nama Pelanggan" class="text ui-widget-content ui-corner-all">
            <label for="email">Alamat</label>
            <input type="text" name="address" id="address" value="" placeholder="Alamat" class="text ui-widget-content ui-corner-all">
        
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>

<script type="text/javascript">
    jQuery(function ($) {
        // set item price
        itemPriceOutlet();

        let data = { branch : branch };
        let token = $('meta[name=branch_token]').attr('content');
        customer(token, data);

        function customer(token, data) {
			let table = $('#dcustomer').DataTable({
				"processing": true,
				"ajax": {
					url: apiURL + "Customer",
					type: "POST",
					data: data,
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
                    { "data": "name" },
                    { "data": "address" },
                    { "data": "telp" },
                    { "data": "status" },
                    {"data":null,"defaultContent":"<button class='btn btn-success btn-xs' align='center' id='selectCustomer'>Pilih</button>"}
                ],
            });
            
            $("#dcustomer tbody").on("click", "#selectCustomer", function () {
                var data = table.row( $(this).parents('tr') ).data();
                let id = data.id;      
                let url = "?menu=sale&id=" + id;
                window.open(url, '_blank');
            });
        }

        let dialog,
            form, 
            telp = $( "#telp" ),
            name = $( "#name" ),
            address = $("#address"),
            allFields = $( [] ).add( telp ).add( name ).add( address );
            tips = $( ".validateTips" );
        
        function updateTips( t ) {
            tips
                .text( t )
                .addClass( "ui-state-highlight" );
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }

        function checkLength( o, n, min, max ) {
            if ( o.val().length > max || o.val().length < min ) {
                o.addClass( "ui-state-error" );
                updateTips( "Panjang kolom " + n + " harus " +
                min + " dan " + max + "." );
                return false;
            } else {
                return true;
            }
        }

        function checkRegexp( o, regexp, n ) {
            let reg = new RegExp(regexp);
            if ( !( reg.test( o.val() ) ) ) {
                o.addClass( "ui-state-error" );
                updateTips( n );
                return false;
            } else {
                return true;
            }
        }

        function addUser() {
            var valid = true;
            allFields.removeClass( "ui-state-error" );

            valid = valid && checkLength( telp, "telp", 11, 12 );
            valid = valid && checkRegexp( telp, /^[0-9]*$/, "contoh. 081245454545" );
            valid = valid && checkLength( name, "nama", 3, 22 );
            valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Kolom nama belum diisi" );
            valid = valid && checkLength( address, "alamat", 5, "bebas" );
                
            if ( valid ) {
                let today = new Date;
                let dd = String(today.getDate()).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0');
                let yyyy = today.getFullYear();

                today = yyyy + '/' + mm + '/' + dd;
                let data = { 
                    telp : telp.val(), 
                    name : name.val(), 
                    address : address.val(), 
                    branch : branch,
                    dateInput :  today,
                    outlet : outlet,
                    userId : userId,                
                };
                saveCustomer(data, function (response) {
                    form[ 0 ].reset();
                    if (response.success == false) {
                        telp.addClass( "ui-state-error" );
                        updateTips( response.message );
                        return false
                    } else {
                        dialog.dialog("close");
                    }
                    $('#dcustomer').DataTable().ajax.reload();
                });  
                
            }
            return valid;
        }

        function saveCustomer(data, result) {      
            $.ajax({
                url: apiURL + "Customer/add",
                type: "POST",
                data: data,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", token);
                },
                success: function (response) {
                    result(response);
                }
            })
        }

        dialog = $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 'auto',
            width: 350,
            modal: true,
            buttons: {
                "Simpan": addUser,
                Cancel: function() {
                    dialog.dialog( "close" );
                }
            },
            close: function() {
                form[ 0 ].reset();
                allFields.removeClass( "ui-state-error" );
            }
        });
        
        form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            addUser();
        });
        
        $("#addCustomer").on("click", function () {
            dialog.dialog( "open" );
        })

    });
</script>