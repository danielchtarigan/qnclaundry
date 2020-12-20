<?php 

class CustomerController extends Controller {

    public function index() {
        $data['data'] = $this->model('Customer')->getCustomer($_POST);
        echo json_encode($data);
    }

    public function add() {
        if ($this->model('Customer')->updateExistChecked(0,"no_telp", $_POST['telp']) > 0) {
            $data['success'] = false;
            $data['message'] = "Nomor telepon sudah terdaftar!";
        } else {
            $data['query'] = $this->model('Customer')->addCustomer($_POST);
            if ($data['query'] > 0) {
                $data['success'] = true;
                $data['message'] = "Pelanggan baru berhasil dibuat";
            }
        }

        echo json_encode($data);
    }
    
    public function getCustomerByOrder() {
        $data = $this->model('Customer')->getCustomerByOrder($_POST);
        echo json_encode($data);
    }

    public function show($customerId) {
        $data = $this->model('Customer')->show($customerId);

        if($data['langganan'] == "Langganan") {
            $data['kuota'] = $this->model('Langganan')->getKuota($customerId);
        }
        if($data['membership'] == "Membership") {
            $data['info_member'] = $this->model('Membership')->show($customerId);
        }


        echo json_encode($data);
    }

    public function update($id)
    {
        //check no telp
        if ($this->model('Customer')->updateExistChecked($id,"no_telp", $_POST['telp']) > 0) {
            $data['success'] = false;
            $data['message'] = "No Telepon sudah terdaftar!";
        }
        else {
            $this->model('Customer')->update($id, $_POST);
            $data['success'] = true;
            $data['message'] = "Data customer berhasil diubah!";
        }
        echo json_encode($data);

    }
}