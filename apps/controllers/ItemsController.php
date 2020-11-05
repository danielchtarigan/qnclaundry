<?php 

class ItemsController extends Controller {

    public function index()
    {
        $data['data'] = $this->model('Items')->get_items();
        echo json_encode($data);
    }
}