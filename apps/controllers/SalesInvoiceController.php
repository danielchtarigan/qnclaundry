<?php 

class SalesInvoiceController extends Controller {
    public function omset($userId)
    {
        // $_POST['outlet'] = 'Toddopuli';
        // $_POST['startDate'] = '2020-04-01';
        // $_POST['endDate'] = '2020-07-30';

        if (Authorize::accessGranted($userId)) {
            if (isset($_POST['outlet'])) {
                $data['outlet'] = $_POST['outlet'];
                $data['startDate'] = $_POST['startDate'];
                $data['endDate'] = $_POST['endDate'];
                $data['data']  = $this->model('SalesInvoice')->getOmsetByOutlet($data);
                echo json_encode($data);
            }

            
        }
        
    }
}