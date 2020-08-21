<?php 

class SalesOrderController extends Controller {
    
    public function tracking()
    {
        if (Authorize::accessGranted($_POST['token'])) {
            $data = $this->model('SalesOrder')->getOrders($_POST);
            echo json_encode($data);
        }
        else {
            echo "Akses pengguna tidak diberikan!";
        }        
    }

    public function data_laundry()
    {
        if (Authorize::accessGranted($_POST['token'])) {
            $data['data'] = $this->model('SalesOrder')->orderByDate($_POST);
            echo json_encode($data);
        }
    }
}