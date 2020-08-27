<?php 
class Controller {
   public function view($view, $data = [])
   {
       include_once 'views/'.$view.'.php';
   }

   public function model($model)
   {       
       if (isset($_POST['token'])) {
           if (Authorize::accessGranted($_POST['token'])) {
               include_once 'models/'.$model.'.php';
               return new $model;
            }
            else {
                echo "Access is not granted";
            }
        }
        else {
            echo "Unauthorized";
        }

   }
}