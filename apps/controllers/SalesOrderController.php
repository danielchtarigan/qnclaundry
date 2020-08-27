<?php 

class SalesOrderController extends Controller {
    
    public function tracking()
    {
        $data = $this->model('SalesOrder')->getOrders($_POST);
        echo json_encode($data);
    }

    public function data_laundry()
    {
        $data['data'] = $this->model('SalesOrder')->orderByDate($_POST);
        echo json_encode($data);
    }
}