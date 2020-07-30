<?php 
include '../../config.php';

$customer = $_GET['customer'];

$data = [];
$orders = "SELECT * FROM reception WHERE id_customer='$customer' AND kembali=true AND ambil=false";
$query =  mysqli_query($con, $orders);
while($row = mysqli_fetch_assoc($query)) {
    $data[$row['no_nota']] = [
        'no_nota' => $row['no_nota'],
        'jenis' => $row['jenis'] == "k" ? "Kiloan" : "Potongan"
    ];
}

?>

<form class="form-inline">
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-addon">Jumlah</div>
      <input type="text" class="form-control" style="width: 60px" id="counter" placeholder="0" readonly>
    </div>
  </div>
  <button type="button" class="btn btn-primary" disabled id="ambil_cucian">Ambil Cucian</button>
</form>

<textarea name="" id="nota" cols="30" rows="3" hidden></textarea>

<br>
<table class="table table-bordered table-stripped table-hover" id="cucian_selesai">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th>No Nota</th>
            <th>Jenis</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($data) > 0) { ?>
        <?php foreach($data as $val) : ?>
            <tr>
                <td>
                    <input type="checkbox" name="nota" id="nota" value="<?= $val['no_nota'] ?>">
                </td>
                <td><?= $val['no_nota'] ?></td>
                <td><?= $val['jenis'] ?></td>
            </tr>

        <?php endforeach ?>
        <?php } else { ?>
            <tr><td align="center" colspan="3">Data tidak ada...</td></tr>
        <?php } ?>
    </tbody>
</table>

<script>

    $('input[type=checkbox]').click(function () {
        let data = [];
        let checkboxes = $('input#nota:checked');
        for (let i = 0; i < checkboxes.length; i++) {
            data[i] = checkboxes[i].value;
        }
        if(checkboxes.length > 0) {
            $('button#ambil_cucian').prop('disabled', false);
        } else {
            $('button#ambil_cucian').prop('disabled', true);
        }
        $('#counter').val(checkboxes.length);
        $('#nota').val(data);
       
    });

    
    $('button#ambil_cucian').on('click', function(e) {
        e.preventDefault();
        data = $('textarea#nota').val().split(',');
        console.log(data.length);
        $.ajax({
            url: 'action/ambil_cucian.php',
            type: 'POST',
            data: {data: data},
            success: function (response) {
               alert(response);
               $('#parse_dialog').dialog('close');
            }
        })
    })

</script>