<?php namespace App\Home\Model;
use App\Model;
class Country_Model extends Model {
	
	private $id;
	private $abbreviation;
    function __construct() {
		parent::__construct('countries');
    } 
    public function setId($id){
		$this->id = $id;
	}
	
	public function setAbbreviation($abbreviation){
		$this->abbreviation = $abbreviation;
	}
    public function getCountries(){
        return $this->getAll($this->table);      
    }
	
	public function getCountryById(){
		$query = "SELECT * FROM $this->table WHERE id = :id";
		return $this->execQuery($query,['id'=>$this->id]);
	}
	
	public function getCountryByAbbreviation(){
		$query = "SELECT * FROM $this->table WHERE abbreviation = :abbreviation";
		return $this->execQuery($query,[':abbreviation'=>$this->abbreviation]);
	}
}

