<?php 


class SalesInvoiceController extends Controller {

    public function omset()
    {
        if (Authorize::accessGranted($_POST['token'])) {
            if (isset($_POST['outlet'])) {
                $data['outlet'] = $_POST['outlet'];
                $data['startDate'] = $_POST['startDate'];
                $data['endDate'] = $_POST['endDate'];
                $result['data']  = $this->model('SalesInvoice')->getOmsetByOutlet($data);
                echo json_encode($result);
            }            
        }
    }

    public function unionPayment()
    {
        $result['data'] = $this->model('SalesInvoice')->invoiceUnionPayment();
        echo json_encode($result);
    }

    public function omset2()
    {
        if (isset($_POST['outlet'])) {
            $data['outlet'] = $_POST['outlet'];
            $data['startDate'] = $_POST['startDate'];
            $data['endDate'] = $_POST['endDate'];
            $result['data']  = $this->model('SalesInvoice')->omsets($data);
            echo json_encode($result);
        }           
    }
}