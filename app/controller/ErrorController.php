<?php
namespace App\Home;
use App\Controller;
class ErrorController extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->msg = "This page dosen't exist";
        $this->view->render('error/error');
    }

}
