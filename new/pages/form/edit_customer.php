
<form id="form_edit_customer">
  <div class="form-group">
    <label for="name">Nama Customer</label>
    <input type="text" class="form-control" id="name" readonly>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <input type="text" class="form-control" id="alamat" placeholder="Alamat">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="telp">Telepon</label>
    <input type="text" class="form-control" id="telp" placeholder="Telepon">
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script>
    let id = '<?= $_GET['id'] ?>';
    $.get('https://qnclaundry.com/apps/customer/show/'+id, function (response) {
        obj = response;
        $('#name').val(obj.nama_customer);
        $('#alamat').val(obj.alamat);
        $('#telp').val(obj.no_telp);
    });

    $('#form_edit_customer').on('submit', function (e) {
        e.preventDefault();
        let id = '<?= $_GET['id'] ?>';
        let alamat = $('#alamat').val();
        let email = $('#email').val();
        let telp = $('#telp').val();
        let token = $('meta[name=branch_token]').attr('content');

        $('.alert').remove();
        $.ajax({
            url: 'https://qnclaundry.com/apps/customer/update/'+id,
            type: 'POST',
            data: {token:token, alamat:alamat, email:email, telp:telp},
            success: function (obj) {  
                if (obj.success) {
                    $('form').before('<div class="alert alert-success" role="alert">'+obj.message+'</div>');
                    location.href = "";
                }
                else {
                    $('form').before('<div class="alert alert-danger" role="alert">'+obj.message+'</div>');
                }
            }

        })
    })
</script>

<style>
    input {
        padding: 8px !important;
    }
</style>
