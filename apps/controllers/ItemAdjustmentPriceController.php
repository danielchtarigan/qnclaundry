<?php 

class ItemAdjustmentPriceController extends Controller {

    public function lists()
    {
        $data = json_decode(json_encode($_POST));
        $datas['data'] = $this->model('ItemAdjustmentPrices')->lists($data);

        echo json_encode($datas);
    }

    public function store_copy()
    {
        $data = json_decode(json_encode($_POST));
        $success = $this->model('ItemAdjustmentPrices')->insertCopy($data);

        echo json_encode($success);
    }

    public function update($data, $id)
    {
        $this->model('ItemAdjustmentPrices')->update($data, $id);
    }

    public function delete()
    {
        $data = json_decode(json_encode($_POST));

        $success = $this->model('ItemAdjustmentPrices')->delete($data);

        echo json_encode($success);
    }
}