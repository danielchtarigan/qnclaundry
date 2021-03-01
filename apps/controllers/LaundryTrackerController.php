<?php

class LaundryTrackerController extends Controller {

    public function getToCheckOutlet($sendKey)
    {
        if ($_POST['checkType'] == "out") {
            $data['data'] = $this->model('LaundryTracker')->getOrderToCheckOutOutlet($sendKey);

            if (empty($data['data'])) {
                $data['data'] = $this->model('SalesOrder')->getOrderToCheckOutOutlet($sendKey);
            }
        } else {
            $data['data'] = $this->model('LaundryTracker')->getOrderToCheckInOutlet($sendKey);
        }

        echo json_encode($data);
    }

    public function getToCheckWorkshop($sendId)
    {
        if ($_POST['checkType'] == "in") {
            $data['data'] = $this->model('LaundryTracker')->getOrderToCheckInWorkshop($sendId);
        } else {
            $data['data'] = $this->model('LaundryTracker')->getOrderToCheckOutWorkshop($sendId);
        }

        echo json_encode($data);
    }
}