<?php 

class CustomPriceController extends Controller {

    public function getDataByPriceId($priceId)
    {
        $data['data'] = $this->model('CustomPrices')->getDataByPriceId($priceId);

        echo json_encode($data);
    }

    public function store()
    {
        $data = json_decode(json_encode($_POST));

        $store = $this->model('CustomPrices')->insert($data);

        echo json_encode($store);
    }

    public function update()
    {
        $data = json_decode(json_encode($_POST));

        $update = $this->model('CustomPrices')->update($data);

        echo json_encode($update);
    }
}