<?php 

class OutletController extends Controller {

    public function index($outlet)
    {
        $data['data'] = $this->model('Outlet')->getOutletByName($outlet);

        echo json_encode($data);
    }

    public function listsByBranch($branch)
    {
        // $branch = $_POST['branch'];
        $data['data'] = $this->model('Outlet')->getOutletsByBranch($branch);

        echo json_encode($data);
    }

    public function lists()
    {
        $data['data'] = $this->model('Outlet')->getOutlets();

        echo json_encode($data);
    }

    public function store()
    {
        $data = json_decode(json_encode($_POST));
        $success = $this->model('Outlet')->updateOutletCode($data);

        if ($data->branch == "Makassar") {
            $this->model('Outlet')->insertOldRulePrice($success);
        }

        echo json_encode($success);
    }

    public function update($outletId)
    {
        $data = json_decode(json_encode($_POST));
        $success = $this->model('Outlet')->updateOutlet($data, $outletId);
        echo json_encode($success);
    }
}