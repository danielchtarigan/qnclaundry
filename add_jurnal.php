<?php

function add_sales_invoice($transactionDate,$transactionNo,$pelanggan,$dueDate,$sumProduct,$productName,$tags,$customeId,$gudang,$warehouseCode,$akunBayar) 
{

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.jurnal.id/core/api/v1/sales_invoices",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => 
        '{
          "sales_invoice": {        
          "transaction_date": "'.$transactionDate.'",
          "transaction_lines_attributes": 
            [{
              "quantity": 1,
              "rate": '.$sumProduct.',
              "discount": 0,
              "product_name": "'.$productName.'"
            }],
            "shipping_date": "",
            "shipping_price": 0,
            "shipping_address": "",
            "is_shipped": false,
            "ship_via": "",
            "reference_no": "",
            "tracking_no": "",
            "address": "",
            "term_name": "",
            "due_date": "'.$dueDate.'",
            "deposit_to_name": "'.$akunBayar.'",
            "deposit": '.$sumProduct.',
            "discount_unit": 0,
            "witholding_account_name": "",
            "witholding_value": 0,
            "witholding_type": "percent",
            "discount_type_name": "percent",
            "person_name": "'.$pelanggan.'",
            "warehouse_name": "'.$gudang.'",
            "warehouse_code": "'.$warehouseCode.'",
            "tags": [ "'.$tags.'" ],
            "email": "quicknclean.indonesia@gmail.com",
            "transaction_no": "'.$transactionNo.'",
            "message": "",
            "memo": "",
            "custom_id": "'.$customeId.'",
            "source": "",
            "use_tax_inclusive": false
          }
        }', 

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
  } 
//   else {
//      echo $response;
//   }

}



// d3bed0100e13cf000e01469ac32e4461


