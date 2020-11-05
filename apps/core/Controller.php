<?php 
class Controller {
   public function view($view, $data = [])
   {
       include_once 'views/'.$view.'.php';
   }

   public function model($model)
   {       
        $header = apache_request_headers();
        $token = $header['Authorization'];
        if (Authorize::accessGranted($token)) {
            include_once 'models/'.$model.'.php';
            return new $model;
        }
        else {
            echo "Access is not granted";
        }

   }
}