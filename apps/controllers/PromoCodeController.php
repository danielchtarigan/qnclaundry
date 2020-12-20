<?php 

class PromoCodeController extends Controller {

    public function get_code($code)
    {
        $data['data'] =  $this->model('PromoCode')->getCode($code);

        echo json_encode($data);
    }
}