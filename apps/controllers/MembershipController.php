<?php 
include_once 'controllers/SalesInvoiceController.php';

class MembershipController extends Controller {

    public function index($outlet)
    {
        if (empty($_POST)) {
            $_POST['start_at'] = "2020-01-01";
            $_POST['end_at'] = date('Y-m-d');
        }
        $data['data'] = $this->model('Membership')->membershipByOutlet($outlet, $_POST);

        echo json_encode($data);
    }

    public function show($customerId)
    {
        $data['data'] = $this->model('Membership')->cekMemberCustomer($customerId);
        
        echo json_encode($data);
    }

    public function save_order($customerId)
    {
        $data = $_POST['getData'];

        date_default_timezone_set($data['timezone']);
        $data['data']['nowdate'] = date('Y-m-d');
        $data['data']['customer_id'] = $customerId;
        $data['item_package'] = "Member ".$data['data']['level'];

        $insertOrder = $this->model('Membership')->insertOrder($data);

        if ($insertOrder > 0) {
            $this->model('Customer')->updateMembership($data['data']);
            $salesInvoice = new SalesInvoiceController();
            $salesInvoice->save_payment_2($data);
        }
    }
}
