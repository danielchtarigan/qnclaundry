<?php 

class BranchController extends Controller {

    public function lists()
    {
        $data['data'] = $this->model('Branch')->getBranches();

        echo json_encode($data);
    }

    public function details()
    {
        $data['data'] = $this->model('Branch')->getBranchOutlet();

        echo json_encode($data);
    }

    public function store()
    {
        $data = json_decode(json_encode($_POST));
        $success = $this->model('Branch')->insertBranch($data);
        echo json_encode($success);
    }

    public function update($id)
    {
        $data = json_decode(json_encode($_POST));
        $success = $this->model('Branch')->updateBranch($data, $id);
        echo json_encode($success);
    }
}