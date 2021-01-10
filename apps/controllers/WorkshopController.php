<?php 

class WorkshopController extends Controller {

    public function lists()
    {
        $data['data'] = $this->model('Workshop')->getWorkshops();

        echo json_encode($data);
    }

    public function store()
    {
        $data = json_decode(json_encode($_POST));
        $success = $this->model('Workshop')->updateWorkshopCode($data);
        echo json_encode($success);
    }

    public function update($id)
    {
        $data = json_decode(json_encode($_POST));
        $success = $this->model('Workshop')->updateWorkshop($data, $id);
        echo json_encode($success);
    }
}