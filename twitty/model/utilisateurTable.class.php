<?php

class utilisateurTable
{
	public static function getUserByLoginAndPass($login,$pass) {
		$connection = new dbconnection();
		$sql = "select * from jabaianb.utilisateur where identifiant='".$login."' and pass='".sha1($pass)."'" ;

		$res = $connection->doQueryObject($sql, "utilisateur");

		if ($res === false || empty($res))
			return null;

		return $res[0];
	}
	
	public static function getUserByLogin($login) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.utilisateur WHERE identifiant='".$login."'" ;

		$res = $connection->doQueryObject($sql, "utilisateur");

		if ($res === false || empty($res))
			return null;

		return $res[0];
	}

	public static function getUserById($id) {
		$connection = new dbconnection() ;
		$sql = "SELECT * FROM jabaianb.utilisateur WHERE id = " . $id;
		
		$res = $connection->doQueryObject($sql, "utilisateur");

		if ($res === false || empty($res))
			return null;

		return $res[0];	
	}

	public static function getUsers() {
		$connection = new dbconnection() ;
		$sql = "select * from jabaianb.utilisateur";
		
		$res = $connection->doQueryObject($sql,"utilisateur");

		if ($res === false)
			return null;

		return $res;
	}
	
	public static function getUsersWhoLikeTweetById($tweetId) {
		$connection = new dbconnection() ;
		$sql = "SELECT U.* FROM jabaianb.utilisateur U
					INNER JOIN jabaianb.vote V ON (U.id = V.utilisateur)
				WHERE V.message = " . $tweetId;
		
		$res = $connection->doQueryObject($sql,"utilisateur");

		if ($res === false)
			return null;

		return $res;				
	}
}

?>
