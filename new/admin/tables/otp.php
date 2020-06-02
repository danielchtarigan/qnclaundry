<?php 
$jam = date('Y-m-d H:i:d'); 
?>

<style>

.tooltips .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltips:hover .tooltiptext {
    visibility: visible;
}

</style>

<div class="app-title">
  <div>
    <h1><i class="fa fa-th-list"></i> Tables</h1>
    <p>Tabel Ontime Performance</p>
  </div>
  <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Tables</li>
    <li class="breadcrumb-item active"><a href="#">Data Terlambat</a></li>
  </ul>
</div>


      
<!-- <div class="tile p-0">
  <h4 class="tile-title folder-head">Ontime Performance</h4>
  <div class="tile-body">
    <ul class="nav nav-pills flex-column mail-nav">     
      <li class="nav-item nav-link"><i class="fa fa-check-square fa-fw"></i> Input - SPK<span class="badge badge-pill badge-success float-right"><?= $data['otp_spk'] ?></span></li>
      <li class="nav-item nav-link"><i class="fa fa-check-square fa-fw"></i> SPK - Packing<span class="badge badge-pill badge-success float-right"><?= $data['otp_operasional'] ?></span></li>
    </ul>
  </div>
</div> -->

<div class="tile">
<div class="tile-body">
  <h4>Data Terlambat</h4><br>
  <div class="table-responsive">
    <table class="table table-hover table-striped" id="otpTable">
        <thead>
          <tr>
            <th width="15%">Input Date</th>
            <th>Number Order</th>
            <th>Customer</th>
            <th>Price Order</th>
            <th>Jenis</th>
            <th class="hide"></th>
            <th>SPK</th>
            <th>Cuci</th>
            <th>Setrika</th>
            <th>Time</th>
            <th class="hide"></th>
          </tr>
        </thead>
        <tbody>
          <?php         

      
          $sql = $con-> query("SELECT a.id, a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, a.rcp_spk FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='$cabang' AND a.nama_outlet='$outlet' AND a.kembali=false AND a.tgl_so='0000-00-00 00:00:00' AND a.rijeck=false AND a.packing=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' ORDER by a.tgl_input DESC");
          while($data = $sql-> fetch_array()){
            $waktus = explode(":",$data['waktu']); 
            ?>
            <tr>
              <td style="vertical-align: middle" id="<?= $waktus[0] ?>"><?= $data['tgl_input'] ?></td>
              <td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
              <td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
              <td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
              <td style="vertical-align: middle"><?= ($data['jenis']=="k") ? "Kiloan" : "Potongan" ?></td>
              <td class="hide"><?= $data['spk'] ?></td>
              <td style="vertical-align: middle">
                <?php 
                $cuci = ($data['tgl_spk']<>"0000-00-00 00:00:00") ? '<a href="#" class="tooltips">Selesai<span class="tooltiptext"">SPK : '.$data['rcp_spk'].'<br>'.$data['tgl_spk'].'</span>' : "Belum";
                echo $cuci;

                ?>
                </a>
              </td>
              <td style="vertical-align: middle">
                <?php 
                $cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<a href="#" class="tooltips">Selesai<span class="tooltiptext"">Cuci : '.$data['op_cuci'].'<br>'.$data['tgl_cuci'].'</span>' : 'Belum';
                echo $cuci;

                ?>
                </a>
              </td>
              <td style="vertical-align: middle">
                <?php 
                $cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<a href="#" class="tooltips">Selesai<span  class="tooltiptext"">Setrika : '.$data['user_setrika'].'<br>'.$data['tgl_setrika'].'</span>' : "Belum";
                echo $cuci;

                ?>
                </a>
              </td>
              <td style="vertical-align: middle">
                <?php               
                echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
                ?>
              </td>
              <td class="hide"><?= $waktus[0] ?></td> 
            </tr>

            <?php

          }


          ?>
        </tbody>
    </table>
  </div>
      
</div>
</div>

<script type="text/javascript">
  $('.hide').hide();

  

</script>
