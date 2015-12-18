<?php

abstract class basemodel
{
	private $data = array();

	public function __construct($pdata = null) {
		if (! empty($pdata)) {
			foreach($pdata as $key => $val) {
			    $this->data[$key] = $val;
			}
		}
	}
	
	public function __set($att, $value) {
		$this->data[$att] = $value;
	}	
	
	public function __get($att) {
		if (array_key_exists($att, $this->data)) {
			return $this->data[$att];
		}
		else {
			return false;
		}
	}
	
	public function __toString() {
	    return implode("|", $this->data);
	}
	

	public function save() {
		$connection = new dbconnection() ;

		if($this->id)
		{
		  $sql = "update jabaianb.".get_class($this)." set " ;

		  $set = array() ;
		  foreach($this->data as $att => $value)
			if($att != 'id' && $value)
			  $set[] = "$att = '".$value."'" ;

		  $sql .= implode(",",$set) ;
		  $sql .= " where id=".$this->id ;
		}
		else
		{
		  $sql = "insert into jabaianb.".get_class($this)." " ;
		  $sql .= "(".implode(",",array_keys($this->data)).") " ;
		  $sql .= "values ('".implode("','",array_values($this->data))."')" ;
		}

		$connection->doExec($sql) ;
		$id = $connection->getLastInsertId("jabaianb.".get_class($this)) ;

		return $id == false ? NULL : $id ; 
	}

}
