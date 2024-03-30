<?php

class Core {

    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){

        $url = $this->getUrl();
        $isAdmin = isset($url[0]) && strtolower((string)$url[0]) === "admin";
        if(isset($url[0]) && $isAdmin){
            if(file_exists("app/controller/admin/".ucwords((string)$url[1]).".php")){
                $this->currentController = ucwords($url[1]);
                unset($url[0]);
                unset($url[1]);
            } else {
                header("location: ".URL);
                exit();
            }

        } else if(isset($url[0])) {
            if(file_exists("app/controller/".ucwords((string)$url[0]).".php")){
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            } else {
                header("location: ".URL);
                exit();
            }
        }

        $isAdmin ? require_once "app/controller/admin/".$this->currentController.".php"
            : require_once "app/controller/".$this->currentController.".php";

        $this->currentController = new $this->currentController;

        if(isset($url[1]) || isset($url[2]) && $isAdmin){
            if($isAdmin){
                if(method_exists($this->currentController,$url[2])){
                    $this->currentMethod = $url[2];
                    unset($url[2]);
                }else{
                    header("location: ".URL);
                    exit();
                }
            } else {
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }else{
                    header("location: ".URL);
                    exit();
                }
            }

        }
        $postData = $_POST;
        $getData = $_GET;
        unset($getData['url']);
        if(!$isAdmin){
            $this->params = !empty($url[2]) && !empty($url[3]) ? [
                $url[2] => $url[3],
                ...$postData,
                ...$getData
            ]:[];
        } else{
            $this->params = !empty($url[3]) && !empty($url[4]) ? [
                $url[3] => $url[4],
                ...$postData,
                ...$getData
            ]:[];
        }

        call_user_func_array(
            [$this->currentController,$this->currentMethod],[$this->params]
        );
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
           return $url;
        }
    }
}

?>