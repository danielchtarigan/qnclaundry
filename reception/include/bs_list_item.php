<!-- <div class="list-group" style="position: absolute; z-index: 2">
    <a href="#" class="list-group-item active">
        Cras justo odio
    </a>
    <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
    <a href="#" class="list-group-item">Morbi leo risus</a>
    <a href="#" class="list-group-item">Porta ac consectetur ac</a>
    <a href="#" class="list-group-item">Vestibulum at eros</a>
</div> -->

<?php
include '../../config.php';
$item = $_GET['item'];
$lists = $con->query("Select * From retail Where nama_barang like '%$item%'");
    echo '
        <div class="list-group" style="position: absolute; z-index: 2">
    ';
if (mysqli_num_rows($lists) > 0) {
    while($data = $lists->fetch_array()) {
        echo '
                <a href="javascript:" class="list-group-item" data-id="'.$data['kode'].'" data-desc="'.$data['nama_barang'].'" data-price="'.$data['harga'].'">
                    '.$data['kode'].' | '.$data['nama_barang'].'
                </a>
        ';
    };
    

}
else {
    echo '
    <a href="javascript:" class="list-group-item">
        <em>Tidak ditemukan...</em>
    </a>
    ';
}
echo '
        </div>
    ';

?>