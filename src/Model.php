<?php
namespace App;
use \PDO;
class Model {
	protected $db;
	protected $table;
    protected $fields = array();
	
    function __construct($table) {
        $this->db = new Datebase();
		$this->table = $table;
		$this->getFields();
    }
	private function getFields(){
        $sql = "DESC ". $this->table;
		$query = $this->db->prepare($sql);
        $query->execute();
		$result = $query->fetchAll();
        foreach ($result as $v) {
            $this->fields[] = $v['Field'];
            if ($v['Key'] == 'PRI') {
                $pk = $v['Field'];
            }
        }
        if (isset($pk)) {
            $this->fields['pk'] = $pk;
        }
    }
	
	public function save($list){
        $field_list = '';
        $value_list = '';
        foreach ($list as $k => $v) {
            if (in_array($k, $this->fields)) {
                $field_list .= "`".$k."`" . ',';
                $value_list .= "'".$v."'" . ',';
            }
        }
        $field_list = rtrim($field_list,',');
        $value_list = rtrim($value_list,',');
        $sql = "INSERT INTO `{$this->table}` ({$field_list}) VALUES ($value_list)";
        if ($lastInsertId = $this->executeQuery($sql)) {
            return $lastInsertId;
        } else {
            return false;
        }
    }

	public function executeQuery($query,$vars = [],$lastInsertId = false){
		$query = $this->db->prepare($query);
        $query->execute($vars);
		$result = $this->db->lastInsertId();
		return $result;
	}
	public function execQuery($query,$vars = []){
		$prep =  $this->db->prepare($query);
		$prep->execute($vars);
		$result = $prep->fetchAll();
		return $result;
	}
	
	public function getAll(){
		$query = $this->db->prepare("SELECT * FROM $this->table");
        $query->execute();
        $result = $query->fetchAll();
		return $result;
	}

	public function getCount($where = []){
		if(!empty($where)){
			$vars = [];
			$query = "SELECT COUNT(*) FROM $this->table WHERE ";
			$count_where = count($where);
			$counter = 0;
			foreach($where as $key=>$value){
				if($counter == $count_where -1){
					$query .= $key.' = :'.$key;
				}else{
					$query .= $key.' = :'.$key .' AND ';
				}
				$vars[':'.$key] = $key;
				$counter++;
			}
			$query = $this->db->prepare($query);
			$query->execute($vars);
		}else{
			$query = $this->db->prepare("SELECT COUNT(*) FROM $this->table");
			$query->execute();
		}
        $count = $query->rowCount();
        return $count;
	}
}
