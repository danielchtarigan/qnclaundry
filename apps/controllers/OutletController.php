<?php 

class OutletController extends Controller {

    public function index($outlet)
    {
        $data['data'] = $this->model('Outlet')->getOutletByName($outlet);

        echo json_encode($data);
    }
}