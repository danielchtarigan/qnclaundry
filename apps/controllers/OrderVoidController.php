<?php 

class OrderVoidController extends Controller {

    public function index()
    {
        $data['data'] = $this->model('OrderVoid')->getItems(json_decode(json_encode($_POST)));

        echo json_encode($data);
    }

    public function store()
    {
        $object = json_decode(json_encode($_POST));
        $data = $this->model('OrderVoid')->insert($object);

        echo json_encode($data);
    }

    public function update($orderNumber)
    {
        $object = json_decode(json_encode($_POST));
        $data = $this->model('OrderVoid')->update($object, $orderNumber);

        echo json_encode($data);
    }
}