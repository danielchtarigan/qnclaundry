
<div class="col-md-6">
	<div class="panel panel-default">		
		<div class="panel-body">
            <h4 style="margin: 10px 0 20px"><i class="ace-icon glyphicon glyphicon-tag"></i> Tracking Laundry</h4>
            <form class="form-horizontal" id="tracking">
                <input type="text" class="form-control" id="nota" placeholder="Nomor nota...">
                <br>
                <input type="submit" class="btn btn-primary btn-md" value="Submit">
            </form>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default" id="result">		
		<div class="panel-body">
            <h4 style="margin: 10px 0 20px"><i class="ace-icon glyphicon glyphicon-tag"></i> Result Tracking</h4>
            <table class="table" width="60%">
                <tr>
                    <td colspan="2" align="center" style="font-weight: bold">Data tidak tersedia</td>
                </tr>
                
            </table>       
		</div>
	</div>
</div>

<script>
    $('#tracking').on('submit', function (e) {
        e.preventDefault();
        let userId = '<?= $_SESSION['id'] ?>';
        let nota = $('#nota').val();

        $('#result table tr').not(':first').remove();

        $.ajax({
            url: 'https://localhost/qnclaundry/apps/SalesOrder/tracking/'+userId,
            method: 'POST',
            data: {nota:nota},
            beforeSend: function () {
                $('#result table tr:first-child>td').text("Sedang memuat...");
            },
            success: function (response) {
                let obj = JSON.parse(response);
                $('#result table tr:first-child>td').text(obj.no_nota);
                $('#result table').append('<tr><td>Tanggal Masuk: '+obj.tgl_input+'</td><td>Diterima Oleh: '+obj.nama_reception+'</td></tr><tr><td>Tanggal SPK: '+obj.tgl_input+'</td><td>Dispk Oleh: '+obj.rcp_spk+'</td></tr><tr><td>Tanggal Cuci: '+obj.tgl_cuci+'</td><td>Dicuci Oleh: '+obj.op_cuci+'</td></tr><tr><td>Tanggal Setrika: '+obj.tgl_setrika+'</td><td>Disetrika Oleh: '+obj.user_setrika+'</td></tr><tr><td>Tanggal Packing: '+obj.tgl_packing+'</td><td>Dipacking Oleh: '+obj.user_packing+'</td></tr>');

                $('#nota').val('');
            }
        })
    })
</script>





