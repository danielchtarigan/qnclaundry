<?php 
include_once 'controllers/SalesInvoiceController.php';

class LanggananController extends Controller {

    public function index($outlet)
    {
        if (empty($_POST)) {
            $_POST['start_at'] = "2020-01-01";
            $_POST['end_at'] = date('Y-m-d');
        }
        $data['data'] = $this->model('Langganan')->langgananByOutlet($outlet, $_POST);

        echo json_encode($data);
    }

    public function save_langganan($customerId)
    {
        $qCurrent = $this->model('Langganan')->getKuota($customerId);
        
        $data = $_POST['getData'];

        date_default_timezone_set($data['timezone']);
        $data['data']['nowdate'] = date('Y-m-d');
        $data['item_package'] = "Paket Kiloan Komplit ".$data['data']['package']." Kg";

        if ($qCurrent) {
            $data['data']['kiloan'] = $qCurrent['kiloan'] + $data['data']['package'];
            $result = $this->model('Langganan')->updateQuotaNow($data);
        } else {
            $data['data']['kiloan'] = $data['data']['package'];
            $result = $this->model('Langganan')->insertQuotaNow($data);
        }

        if($result > 0) {
            $this->model('Customer')->updateStatusLangganan($customerId);
            $salesInvoice = new SalesInvoiceController();
            $salesInvoice->save_payment_2($data);
        }
    }
}
