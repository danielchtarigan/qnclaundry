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

    public function set_order_number($outlet)
    {
        date_default_timezone_set('Asia/Makassar');
        $ym = date('ymd');
        $dataCode = $this->model('SalesOrder')->getCodeOutlet($outlet);
        $codeOutlet = 'SO'.sprintf('%02s', $dataCode['branchId']).sprintf('%02s', $dataCode['outletId']).$ym;

        $lastNumber = $this->model('SalesOrder')->getOrderNumber($codeOutlet);
        if ($lastNumber) {
            $addNumber = (int) substr($lastNumber['orderNumber'], 13, 3) + 1;
        }
        else {
            $addNumber = 1;
        }
        
        $orderNumber = $codeOutlet.sprintf('%03s', $addNumber);    
        
        $data = [
            'order_number' => $orderNumber
        ];

        echo json_encode($data);
    }

    public function save_order($customerId)
    {
        $customer = $this->model('Customer')->getCustomerById($customerId)['name'];
        date_default_timezone_set('Asia/Makassar');
        $dateNow = date('Y-m-d H:i:s');
        
        $getData = json_decode($_POST['jsonData']);

        $express = 0;
        foreach($getData->data as $data) {
            if ($data->category == "Express") {
                if ($data->item == "Express 24 Jam") {
                    $express = 1;
                    break;
                }
                if ($data->item == "Express 12 Jam") {
                    $express = 2;
                    break;
                }
                if ($data->item == "Express 6 Jam") {
                    $express = 3;
                    break;
                }
                break;
            }
        }

        $dataOrder = [
            'order_number' => $getData->order_number,
            'customer_id' => $customerId,
            'customer' => $customer,
            'outlet' => $getData->outlet,
            'branch' => $getData->branch,
            'datenow' => $dateNow,
            'user' => $getData->user,
            'total' => $getData->total,
            'discount' => $getData->discount,
            'is_weight' => $getData->weight,
            'is_type' => $getData->type,
            'express' => $express
        ];

        $saveOrder = $this->model('SalesOrder')->saveOrder($dataOrder);

        if ($saveOrder > 0) {
            $saveOrderItem = $this->model('SalesOrder')->saveOrderItem($getData, $dateNow, $customerId);
        }

        if ($saveOrderItem > 0) {
            $this->list_order_created($customerId);
        }
    }

    public function list_order_created($customerId) 
    {
        $outlet = $_POST['outlet'];
        $data['data'] = $this->model('SalesOrder')->getOrdersCreated($customerId, $outlet);

        foreach ($data['data'] as $key => $value) {
            $data['data'][$key]['items'] = $this->model('SalesOrder')->getOrderItems($value['orderNumber']);
        }

        echo json_encode($data);
    }

    public function remove_order($orderNumber) 
    {
        if ($this->model('SalesOrder')->deleteOrder($orderNumber) > 0) {
            $removeOrder = $this->model('SalesOrder')->deleteOrderItems($orderNumber);
        }

        if ($removeOrder > 0) {
            $this->list_order_created($_POST['customerId']);
        }
    }

    public function get_list_order($orderNumber)
    {
        $outlet = $_POST['outlet'];
        $data = $this->model('Outlet')->getOutletByName($outlet);
        $data['data'] = $this->model('SalesOrder')->getListOrderItem($orderNumber);

        echo json_encode($data);
    }

    public function laundry_already($customerId)
    {
        $data['data'] = $this->model('SalesOrder')->getLaundryAlready($customerId);

        echo json_encode($data);
    }

    public function getOrderToCheckOutlet($outlet)
    {
        if ($_POST['keterangan'] == "kotor") {
            $data['data'] = $this->model('SalesOrder')->getOrderToCheckOutOutlet($outlet);
        } else {
            $data['data'] = $this->model('SalesOrder')->getOrderToCheckInOutlet($outlet);
        }

        echo json_encode($data);
    }
}