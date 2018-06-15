<?php
namespace App;
class View {

    function __construct() {}

    public function render($name,$variables = []) {
			extract($variables);
            require 'app/view/header.php';
            require 'app/view/' . $name . '.php';
            require 'app/view/footer.php';
    }
	
	public function renderPartial($name,$variables = []){
		ob_start();
		extract($variables);
		include 'app/view/' . $name . '.php';
		$out1 = ob_get_clean();
		return $out1;
	}
}
