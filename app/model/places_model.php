<?php namespace App\Home\Model;
use App\Model;
class Places_Model extends Model {
	
	private $id;
	private $name;
	private $latitude;
	private $longitude;
	private $zip_id;
	private $country_id;
    function __construct() {
		parent::__construct('places');
    } 

    public function getPlace($zip_id){
		$query = "SELECT * FROM $this->table WHERE zip_id = :zip_id";
        return $this->execQuery($query,[':zip_id'=>$zip_id]);      
    }
}

