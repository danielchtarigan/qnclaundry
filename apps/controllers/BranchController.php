<?php 

class BranchController extends Controller {

    public function lists()
    {
        $data['data'] = $this->model('Branch')->getBranches();

        echo json_encode($data);
    }
}