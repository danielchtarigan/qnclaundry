<?php 

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

        $data = $_POST['dataOrder'];

        if ($qCurrent) {
            $data['kiloan'] = $qCurrent['kiloan'] + $data['package'];
            $data['result'] = $this->model('Langganan')->updateQuotaNow($data);
        } else {
            $data['kiloan'] = $data['package'];
            $data['result'] = $this->model('Langganan')->insertQuotaNow($data);
        }

        if($data['result'] > 0) {
            $data['lgn'] = $this->model('Customer')->updateStatusLangganan($customerId);

            $this->model('SalesInvoice')->insertSalesPayment($data);

        }

        // $this->conn->bind('invoice_number', $data->invoice_number);
        // $this->conn->bind('outlet', $data->outlet);
        // $this->conn->bind('user', $data->user);
        // $this->conn->bind('nowdate', $data->nowdate);
        // $this->conn->bind('total_pay', $data->total_pay);
        // $this->conn->bind('pay_method', $data->method);
        // $this->conn->bind('customer_id', $data->customer_id);
        // $this->conn->bind('istype', $data->type);

        echo json_encode($data);
    }
}
