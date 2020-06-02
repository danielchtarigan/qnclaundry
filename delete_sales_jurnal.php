<?php

function delete_invoice($customeId) {
    
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.jurnal.id/core/api/v1/sales_invoices/".$customeId."",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_POSTFIELDS => "{}",
    CURLOPT_HTTPHEADER => array(
      "apikey: d3bed0100e13cf000e01469ac32e4461",
      "content-type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
}


$customeId = $_GET['id'];
// include 'config.php';
// $sql = mysqli_query($con, "SELECT no_penjualan_produk FROM penjualan_kasir WHERE DATE(tgl_transaksi) BETWEEN '2019-01-19' AND '2019-01-31' AND penjualan='deposit' ");
// while($data = mysqli_fetch_array($sql)){
//     $customeId = $data[0];
//     delete_invoice($customeId);
// }

delete_invoice($customeId);


	
?>

  