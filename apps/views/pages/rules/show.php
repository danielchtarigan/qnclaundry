<div class="card">
    <div class="card-body">
        <div class="text-left">
            <button  class="btn btn-primary updaterule" id="updaterule" style="margin-bottom: 15px">Perbarui</button>
        </div>
        <ul class="list-group list-group-horizontal text-left" id="data-rule">
            <?php foreach($data['rule_details'] as $detail) : ?>
            <li class="list-group-item">
                <p class="card-text"><?= $detail['name'] ?></p>
                <form action="#" id="form-rule" data-id="<?= $detail['id'] ?>">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>" id="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>1" value="1" <?= $detail['status'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>1">
                            Ya
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>" id="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>2" value="0" <?= $detail['status'] == 0 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>2">
                            Belum
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>" id="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>3" value="3" <?= $detail['status'] == 3 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="<?= strtolower(str_replace(' ', '_', $detail['name']))  ?>3">
                            Abaikan
                        </label>
                    </div>
                </form>
            </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>



<script>
    $('#updaterule').on('click', function () {  

        let data = [];
        $('#data-rule #form-rule').each(function name() {
            let id = $(this).data('id');
            let name = $(this).find('input[type=radio]').attr('name');
            let status = $('input[name='+name+']:checked').val();
            
            let formData = {};
            formData = {status: status, id: id}

            data.push(formData);
        });

        $.ajax({
            url: 'rule/update/',
            method: 'POST',
            dataType: 'json',
            data: { data: JSON.stringify(data) },
            success : function (response) {
                $('.flash-message').html(flash('Data rule laundry', 'berhasil', 'diperbarui', 'success'));                                 
                setTimeout(() => {
                    location.href = "";
                }, 800);

            },
            error: function () {
                $('.flash-message').html(flash('Data rule laundry', 'gagal', 'diperbarui', 'danger'));  
                setTimeout(() => {
                    location.href = "";
                }, 800);                  
            }
        })

    });

    
</script>