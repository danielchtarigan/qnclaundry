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
        
        // $data = [
        //     'order_number' => $orderNumber
        // ];

        return $orderNumber;
    }

    public function save_order($customerId)
    {
        $getData = json_decode($_POST['jsonData']);

        date_default_timezone_set($getData->time_zone);
        $dateNow = date('Y-m-d H:i:s');
        

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
            'customer' => $getData->customer,
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

    public function store($customerId)
    {
        $dataPost = json_decode($_POST['jsonData']);
        date_default_timezone_set($dataPost->timezone);
        $dateNow = date('Y-m-d H:i:s');

        $express = 0;
        
        if (isset($dataPost->express)) {
            foreach($dataPost->express as $data) {
                if ($data->name == "express") {
                    $express = 1;
                    break;
                }
                if ($data->name == "double_express") {
                    $express = 2;
                    break;
                }
                if ($data->item == "triple_express") {
                    $express = 3;
                    break;
                }
            }
        }

        if ($dataPost->category == 1) {
            $type = "k";
        } else if ($dataPost->category == 2) {
            $type = "p";
        }

        $number = $this->set_order_number($dataPost->outlet);

        $dataStore = [
            'order_number' => $number,
            'customer_id' => $customerId,
            'customer' => $dataPost->customer_name,
            'outlet' => $dataPost->outlet,
            'branch' => $dataPost->branch,
            'datenow' => $dateNow,
            'user' => $dataPost->user,
            'total' => $dataPost->total,
            'discount' => $dataPost->discount,
            'is_weight' => $dataPost->weight,
            'is_type' => $type,
            'express' => $express
        ];

        $hasSave = $this->model('SalesOrder')->insert($dataPost, $dataStore);
    
        echo json_encode($number);
    }

    public function order_invoice($customerId)
    {
        $outlet = $_POST['outlet'];
        $data['data'] = $this->model('SalesOrder')->getOrderInvoice($customerId, $outlet);

        echo json_encode($data);
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
            $this->order_invoice($_POST['customerId']);
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

    public function handover_customer()
    {
        date_default_timezone_set($_POST['timezone']);
        $date = date('Y-m-d H:i:s');

        $dataPost = json_decode(json_encode($_POST['data']));

        $dataFields = [
            "operation" => "ambil",
            "field_date" => "tgl_ambil",
            "date" => $date,
            "field_user" => "reception_ambil",
            "user" => $_POST['user']
        ];

    $objectField = json_decode(json_encode($dataFields));

        $up = $this->model("SalesOrder")->updateOpr($dataPost, $objectField);

        echo json_encode($up);
    }
}