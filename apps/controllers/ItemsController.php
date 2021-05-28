<?php 
include_once 'models/ItemAdjustmentPrices.php';
include_once 'models/CustomPrices.php';

class ItemsController extends Controller {

    public function index()
    {        
        $data['data'] = $this->model('Items')->getItemPriceByOutlet($_POST['branch_id'], $_POST['outlet_id']);

        echo json_encode($data);
    }

    public function details()
    {
        $data['data'] = $this->model('Items')->getItems();

        echo json_encode($data);
    }

    public function store()
    {
        $data = json_decode(json_encode($_POST));

        $success = $this->model('Items')->insertAdjustmentPrice($data);

        echo json_encode($success);
    }

    public function update($id)
    {
        $data = json_decode(json_encode($_POST));
        
        $success = $this->model('Items')->update($data, $id);    

        echo json_encode($success);
    }

    public function checkItemInOutlet()
    {
        $check = $this->model('Items')->checkOutletInItem($_POST['outlet_id']);
        return $check;
    }

    public function checkItemInBranch()
    {
        $check = $this->model('Items')->checkBranchInItem($_POST['branch_id']);
        return $check;
    }

}