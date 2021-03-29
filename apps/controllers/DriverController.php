<?php

class DriverController extends Controller {

    public function index()
    {
        //
    }

    public function getDriver($branchId) 
    {
        $data['data'] = $this->model('Driver')->getDriverLogin($branchId);

        // $data['data'] = "Hai";

        echo json_encode($data);
    }

    public function signOut($driverId)
    {
        $signOut = $this->model('Driver')->update($driverId);

        echo json_encode($signOut);
    }
}