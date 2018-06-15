<?php namespace App\Home\Model;
use App\Model;
class Zip_Model extends Model {
	
	private $id;
	private $zip_code;
    function __construct() {
		parent::__construct('zip_codes');
    } 
    public function setId($id){
		$this->id = $id;
	}
	
	public function setZipCode($zip_code){
		$this->zip_code = $zip_code;
	}
	
	public function getZipIdByCode($zip_code){
		$query = "SELECT * FROM $this->table WHERE zip_code = :zip_code";
        return $this->execQuery($query,[':zip_code'=>$zip_code]);  
	}
}

