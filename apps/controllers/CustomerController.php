<?php 

class CustomerController extends Controller {
    
    public function show($id) {
        $data = $this->model('Customer')->show($id);

        echo json_encode($data);
    }

    public function update($id)
    {
        if (Authorize::accessGranted($_POST['token'])) {
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
}