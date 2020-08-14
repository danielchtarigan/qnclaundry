<?php 

class SalesOrderController extends Controller {
    
    public function tracking($userId)
    {
        echo Authorize::getUser($userId);
        // $this->model('SalesOrder')->getOrders($userId, $_POST);
    }
}