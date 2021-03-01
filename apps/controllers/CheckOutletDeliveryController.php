<?php 

class CheckOutletDeliveryController extends Controller {

    public function list()
    {
        $getData = json_decode(json_encode($_POST));

        $data['data'] = $this->model('CheckOutletDelivery')->getList($getData);

        echo json_encode($data);
    }

    public function setCode($data)
    {
        date_default_timezone_set($data->timezone);
        $ym = date('ym');

        if ($data->check_type == "out") {
            $char = "COO";
        } else {
            $char = "CIO";
        }
        
        $row = $this->model('CheckOutletDelivery')->getLastCode($data);

        $number = 1;
        if (!empty($row)) {
            $number = (int) substr($row['code'], 11, 3) + 1;
        }

        $code = $char.sprintf("%03s", $data->outlet_id).$ym.sprintf("%03s", $number);

        return $code;
    }

    public function store()
    {
        $data = json_decode(json_encode($_POST));

        $code = $this->setCode($data);
        $data->code = $code;

        if ($data->check_type == "in") {
            $data->field_tracker = "checkin_outlet";
        } else {
            $data->field_tracker = "checkout_outlet";
        }

        $store = $this->model('CheckOutletDelivery')->insert($data);

        if ($store > 0) {
            $getData = [
                "code" => $code,
                "sales_order" => $data->list,
                "count" => count($data->list)
            ];
        }

        echo json_encode($getData);
    }
}