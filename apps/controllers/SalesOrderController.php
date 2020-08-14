<?php 

class SalesOrderController extends Controller {
    
    public function tracking($userId)
    {
        if (Authorize::accessGranted($userId)) {
            $data = $this->model('SalesOrder')->getOrders($_POST);
            echo json_encode($data);
        }
        else {
            echo "Akses pengguna tidak diberikan!";
        }

        
    }
}