<?php 

class ItemsController extends Controller {

    public function index()
    {        
        if ($this->checkItemInOutlet() > 0) {
            $data['data'] = $this->get_price_outlet();
        } else if ($this->checkItemInBranch() > 0) {
            $data['data'] = $this->get_price_branch();
        } else {
            $data['data'] = $this->get_price_default();
        }        
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

    public function get_price_outlet()
    {
        $data['data'] = $this->model('Items')->getItemPriceByOutlet($_POST['branch_id'], $_POST['outlet_id']);
        echo json_encode($data);
    }

    public function get_price_branch()
    {
        $data['data'] = $this->model('Items')->getItemPriceByBranch($_POST['branch_id']);
        echo json_encode($data);
    }

    public function get_price_default()
    {
        $data['data'] = $this->model('Items')->getItemPriceDefault();
        echo json_encode($data);
    }
}