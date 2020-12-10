<?php 

class SalesInvoiceController extends Controller {

    public function omset()
    {
        $result['data']  = $this->model('SalesInvoice')->getOmsetByOutlet($_POST);
        echo json_encode($result);
    }

    public function set_invoice_number($outlet)
    {
        date_default_timezone_set('Asia/Makassar');
        $ym = date('ymd');
        $dataCode = $this->model('Outlet')->getCodeOutlet($outlet);
        $codeOutlet = 'IP'.sprintf('%02s', $dataCode['branchId']).sprintf('%02s', $dataCode['outletId']).$ym;

        $lastNumber = $this->model('SalesInvoice')->getInvoiceNumber($codeOutlet);
        if ($lastNumber) {
            $addNumber = (int) substr($lastNumber['invoiceNumber'], 13, 3) + 1;
        }
        else {
            $addNumber = 1;
        }
        
        $invoiceNumber = $codeOutlet.sprintf('%03s', $addNumber);    
        
        $data = [
            'invoice_number' => $invoiceNumber
        ];

        echo json_encode($data);
    }

    public function save_payment($customerId)
    {
        date_default_timezone_set('Asia/Makassar');
        $dateNow = date('Y-m-d H:i:s');

        $data = json_decode($_POST['jsonData']);
        $data->nowdate = $dateNow;

        if ($this->model('SalesInvoice')->insertSalesPayment($data) > 0) {
            $data->success_method = $this->model('SalesInvoice')->insertSalesPaymentMethod($data);
        }

        if ($data->success_method > 0) {
            $data->success_pay_off = $this->model('SalesOrder')->updateOrderPayOff($data);
        }

        if (count($data->data_kuota) > 0 && $data->success_pay_off) {
            $data->success_kuota = $this->model('Langganan')->updateQuota($data);
        }


        echo json_encode($data);
    }

    public function get_payments_history($customerId)
    {
        $data['data'] = $this->model('SalesInvoice')->getPaymentsByCustomer($customerId);

        echo json_encode($data);
    }

    public function omset_order()
    {
        $data['data']  = $this->model('SalesInvoice')->getOmsetByOrder($_POST);

        echo json_encode($data);
    }
}