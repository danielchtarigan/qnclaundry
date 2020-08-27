<?php 

class SalesInvoiceController extends Controller {

    public function omset()
    {
        $result['data']  = $this->model('SalesInvoice')->getOmsetByOutlet($_POST);
        echo json_encode($result);
    }

    public function omset_order()
    {
        $data['data']  = $this->model('SalesInvoice')->getOmsetByOrder($_POST);

        echo json_encode($data);
    }
}