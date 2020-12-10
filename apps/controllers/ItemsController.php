<?php 

class ItemsController extends Controller {

    public function index($customerId)
    {
        // Cek Customer
        $customer = $this->model('Customer')->show($customerId);

        $data['status'] = $customer['langganan'] == "Langganan" ? 1 : ($customer['membership'] == "Membership" ? 2 : 0);
        
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
}