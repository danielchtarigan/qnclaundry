<?php 
class App {
    protected $controller = 'rulesController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->url();
        
        if(file_exists('controllers/'.$url[0].'Controller.php')) {
            $this->controller = $url[0].'Controller';
            unset($url[0]);
        }

        unset($url[0]);

        // initial controller
        include_once 'controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller;

        // initial method
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // initial params
        if(!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function url()
    {
        if(isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = explode('/', rtrim($url, '/'));
            return $url;
        }
    }
}