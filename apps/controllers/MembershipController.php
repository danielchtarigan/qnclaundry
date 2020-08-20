<?php 

class MembershipController extends Controller {

    public function index($outlet)
    {
        if (Authorize::accessGranted($_POST['token'])){
            if (empty($_POST)) {
                $_POST['start_at'] = "2020-01-01";
                $_POST['end_at'] = date('Y-m-d');
            }
            $data['data'] = $this->model('Membership')->membershipByOutlet($outlet, $_POST);
    
            echo json_encode($data);
        }
    }
}
