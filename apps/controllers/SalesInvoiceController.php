<?php 

class SalesInvoiceController {
    public function omset($userId)
    {
        if (Authorize::accessGranted($userId)) {
            $data = $this->model('SalesInvoice')->getOmsetByOutlet($_POST);
            $data = (object) $data;
        }
        
    }
}