<?php
namespace App;
use App\View;
class Controller {
    function __construct() {
        $this->view = new View();
    }
    
    public function loadModel($name){
        $pathe = "/app/model/".$name."_model.php";    
        if(file_exists($pathe)){
            require "model/" . $name . "_model.php";
            $modelName = $name . "_model";
            $this->model = new $modelName ;
        }
    }

}
