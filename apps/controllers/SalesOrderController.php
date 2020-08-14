<?php 

class SalesOrderController extends Controller {
    
    public function tracking($userId)
    {
        if (Authorize::accessGranted($userId)) {
            $this->model('SalesOrder')->getOrders($_POST);
        }
    }
}