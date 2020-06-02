<html>
<head>

  <?php

  date_default_timezone_set('Asia/Makassar');
  $jam=date("Y-m-d H:i:s");
  include "header.php";
  include "../config.php";
  if (isset($_GET['tanggal_awal'])) $tanggal_awal = htmlspecialchars($_GET['tanggal_awal']);
  if (isset($_GET['tanggal_akhir'])) $tanggal_akhir = htmlspecialchars($_GET['tanggal_akhir']);

  ?>
</head>
<body>
  <div class="container" style="width:1250px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">
    <script type="text/javascript">
    $(document).ready(function(){
      $('#delivery').dataTable({
        "order": [[ 0,"asc" ]],
        "lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
        dom: 'T<"clear">lfrtip',
        tableTools: {
          "sSwfPath": "swf/copy_csv_xls_pdf.swf",
          "aButtons": [
            {
              "sExtends": "copy",
              "mColumns": [0,1,2,3],
              "oSelectorOpts": { filter: "applied", order: "current" }
            },
            {
              'sExtends': 'xls',
              "mColumns": [0,1,2,3],
              "oSelectorOpts": { filter: 'applied', order: 'current' }
            },

            {
              'sExtends': 'print',
              "mColumns": [0,1,2,3],
              "oSelectorOpts": { filter: 'applied', order: 'current' }
            }

          ]
        },
        "columnDefs": [
          {
            "targets": [0],
            "visible": true,
            "searchable": true,"width":"5%",
          },
        ],
        "bAutoWidth": false,
        "bJQueryUI" : true,
        "sPaginationType" : "full_numbers",
        "iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
          if (aData[8] == 0) {
            $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
          } else if(aData[8] >= 1){
            $('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
          }
        }
      });

  });
  </script>

      <fieldset>
        <legend align="center" ><marquee behavior=alternate  width="800"><strong>Tabel Poin Delivery</strong></marquee></legend>
        <?php 
          if (isset($tanggal_awal)&&isset($tanggal_akhir)) {
            $startDate = strtotime($tanggal_awal);
            $endDate = strtotime($tanggal_akhir);
          } else {
            $bulan = date("m");
            $tahun = date("Y");
            if (date("d")<26) {
              $startMonth = $bulan-1;
              $startYear = $tahun;
              $startDate = mktime(0,0,0,$bulan-1,26,$tahun);
              $endDate = mktime(0,0,0,$bulan,25,$tahun);
              if ($startMonth==0) {
                $startMonth = 12;
                $startYear = $tahun-1;
              }
            } else {
              $startMonth = $bulan;
              $startYear = $tahun;
              $startDate = mktime(0,0,0,$bulan,26,$tahun);
              $endDate = mktime(0,0,0,$bulan+1,25,$tahun);
            }
          }
        ?>
        <form action="laporan_delivery.php">
          <input type="text" name="tanggal_awal" value="<?php echo date('d-m-Y',$startDate); ?>" required></input>
   sampai
          <input type="text" name="tanggal_akhir" value="<?php echo date('d-m-Y',$endDate); ?>" required></input>
          <button class="btn btn-default" type="submit">Ganti Tanggal</button>
        </form>
        <h4><?php echo 'Tanggal '.date("d F Y",$startDate).' - '.date("d F Y",$endDate); ?></h4>
        <table id="delivery" class="display" style="font-size:14px">
          <thead>
            <tr>
              <th>Nama Pengantar</th>
              <th>Poin</th>
              <th>Jumlah Delivery</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $startDate = date("Y/m/d",$startDate);
            $endDate = date("Y/m/d",$endDate);
            $query = "SELECT nama_pengantar, SUM(poin) as poin_total, SUM(jumlah_delivery) as total_delivery FROM delivery_poin WHERE DATE_FORMAT(tanggal, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate' GROUP BY nama_pengantar";
            $tampil = mysqli_query($con, $query);
            while($data = mysqli_fetch_array($tampil)){ ?>
              <tr>
                <td><?php echo $data['nama_pengantar']; ?></td>
                <td><?php echo $data['poin_total']; ?></td>
                <td><?php echo $data['total_delivery']; ?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </fieldset>

    </div>
   
  </body>
</html>
