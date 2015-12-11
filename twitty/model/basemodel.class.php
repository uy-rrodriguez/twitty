<?php

abstract class basemodel
{
	private $data = null;

	public function save() {
		$connection = new dbconnection() ;

		if($this->id)
		{
		  $sql = "update ".get_class($this)." set " ;

		  $set = array() ;
		  foreach($this->data as $att => $value)
			if($att != 'id' && $value)
			  $set[] = "$att = '".$value."'" ;

		  $sql .= implode(",",$set) ;
		  $sql .= " where id=".$this->id ;
		}
		else
		{
		  $sql = "insert into ".get_class($this)." " ;
		  $sql .= "(".implode(",",array_keys($this->data)).") " ;
		  $sql .= "values ('".implode("','",array_values($this->data))."')" ;
		}

		$connection->doExec($sql) ;
		$id = $connection->getLastInsertId("jabaianb.".get_class($this)) ;

		return $id == false ? NULL : $id ; 
	}
  
	public function __construct($array = null) {
		if($array != null) {
			$this->data = $array;
		}
		else {
			$this->data = array();
		}
	}
	
	public function __set($att, $value) {
		$this->data[$att] = $value;
	}	
	
	public function __get($att) {
		if(array_key_exists($att,$this->data)) {
			return $this->data[$att];
		}
		else {
			return "";
		}
	}

}
