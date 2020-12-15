<?php 

class ItemsController extends Controller {

    public function index()
    {        
        $branch = $this->model('Branch')->getBranchId($_POST['branch'])['id'];
        $outlet = $this->model('Outlet')->getOutletId($_POST['outlet'])['id'];

        // Ambil harga cabang dan outlet
        $priceByOutlet = $this->model('Items')->getItemPriceByOutlet($branch, $outlet);

        // Ambil harga cabang
        $priceByBranch = $this->model('Items')->getItemPriceByBranch($branch);

        // Ambil harga default        
        $priceDefault = $this->model('Items')->getItemPriceDefault();

        if (count($priceByOutlet) > 0) {
            $data['data'] = $priceByOutlet;
        } else if (count($priceByBranch) > 0) {
            $data['data'] = $priceByBranch;
        } else {
            $data['data'] = $priceDefault;
        }

        echo json_encode($data);
    }

    public function item_price_outlet()
    {
        $branchId = $this->model('Branch')->getBranchId($_POST['branch'])['id'];
        $outletId = $this->model('Outlet')->getOutletId($_POST['outlet'])['id'];

        $data['check_outlet'] = $this->model('Items')->checkOutletInItem($outletId);
        $data['check_branch'] = $this->model('Items')->checkBranchInItem($branchId);

        echo json_encode($data);
    }

    public function get_price_outlet()
    {
        $branchId = $this->model('Branch')->getBranchId($_POST['branch'])['id'];
        $outletId = $this->model('Outlet')->getOutletId($_POST['outlet'])['id'];
        $data['data'] = $this->model('Items')->getItemPriceByOutlet($branchId, $outletId);
        echo json_encode($data);
    }

    public function get_price_branch()
    {
        $branchId = $this->model('Branch')->getBranchId($_POST['branch'])['id'];
        $data['data'] = $this->model('Items')->getItemPriceByBranch($branchId);
        echo json_encode($data);
    }

    public function get_price_default()
    {
        $data['data'] = $this->model('Items')->getItemPriceDefault();
        echo json_encode($data);
    }
}