<?php 

class SalesOrderController extends Controller {
    
    public function tracking($userId)
    {
        // $_POST['nota'] = 'SOIMB200728001';
        if (Authorize::accessGranted($userId)) {
            $data = $this->model('SalesOrder')->getOrders($_POST);
        }

        $data = (object) $data[0];
        
    }
}