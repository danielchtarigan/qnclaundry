<?php 

class LanggananController extends Controller {

    public function index($outlet)
    {
        if (empty($_POST)) {
            $_POST['start_at'] = "2020-01-01";
            $_POST['end_at'] = date('Y-m-d');
        }
        $data['data'] = $this->model('Langganan')->langgananByOutlet($outlet, $_POST);

        echo json_encode($data);
    }
}
