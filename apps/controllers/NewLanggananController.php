<?php 
include_once 'controllers/SalesInvoiceController.php';

class NewLanggananController extends Controller {

    public function store($customerId)
    {
        $data = $_POST['getData'];

        $qCurrent = $this->model('NewLangganan')->getKuota($customerId, $data['outlet_id']);

        date_default_timezone_set($data['timezone']);
        $data['data']['nowdate'] = date('Y-m-d');
        $data['item_package'] = "Paket Kiloan Komplit ".$data['data']['package']." Kg";

        if ($qCurrent) {
            $data['data']['kiloan'] = $qCurrent['kiloan'] + $data['data']['package'];
            $result = $this->model('NewLangganan')->updateQuotaNow($data);
        } else {
            $data['data']['kiloan'] = $data['data']['package'];
            $result = $this->model('NewLangganan')->insertQuotaNow($data);
        }

        if($result > 0) {
            $this->model('Customer')->updateStatusLangganan($customerId);
            $salesInvoice = new SalesInvoiceController();
            $salesInvoice->save_payment_2($data);

            $res = $this->model('NewLangganan')->cekLanggananCustomer($customerId, $data['branch']);
            echo json_encode($res);
        }

    }
}