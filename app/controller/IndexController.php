<?php
namespace App\Home;
use App\Controller;
use App\Home\Model\Country_Model;

class IndexController extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $msg = "Welcome to My MVC project";
		$countryModel = new Country_Model();
		$countries = $countryModel->getCountries();
        $this->view->render('index/index',['countries'=>$countries]);
    }
}
