<?php

class postTable
{

	public static function getPostById($id) {
		$connection = new dbconnection() ;
		$sql = "select * from jabaianb.post where id = " . $id;
		
		$res = $connection->doQueryObject($sql,"post");

		if (empty($res))
			return false;

		return $res[0];
	}

}

?>