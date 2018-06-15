<?php
namespace App;
use App\Home\IndexController;
use App\Home\AjaxController;
use App\Session;
use App\Home\ErrorController;
class Boostrap {

    function __construct() {
        $url = isset($_GET["url"]) ? $_GET["url"] : NULL;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if (empty($url[0]) || $url[0] == 'index') {
            $controller = new IndexController();
            $controller->index();
            return FALSE;
        }elseif(isset($url[0]) && $url[0] == 'ajax'){
			$controller = new AjaxController();
            $controller->search();
            return FALSE;
		}else{
			require 'app/controller/ErrorController.php';
			$error = new ErrorController();
			$error->index();
			return FALSE;
		}
    }
	
	protected function getNamespace()
    {
        $namespace = 'App\Home\\';
        return $namespace;
    }
}
