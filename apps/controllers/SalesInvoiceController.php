<?php 

class SalesInvoiceController extends Controller {

    public function omset()
    {
        $_POST['outlet'] = 'Baruga';
        $_POST['startDate'] = '2020-01-01';
        $_POST['endDate'] = '2020-01-30';
        $result['data']  = $this->model('SalesInvoice')->getOmsetByOutlet($_POST);
        echo json_encode($result);
    }

    public function omset_order()
    {
        $data['data']  = $this->model('SalesInvoice')->getOmsetByOrder($_POST);

        echo json_encode($data);
    }
}