<?php 
class Controller {
   public function view($view, $data = [])
   {
       include_once 'views/'.$view.'.php';
   }

   public function model($model)
   {
       include_once 'models/'.$model.'.php';
       return new $model;
   }
}