<?php

class tweetTable
{
	public static function getTweets() {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.tweet ORDER BY id DESC" ;
		$res = $connection->doQueryObject($sql, "tweet");

		if ($res === false)
			return null;

		return $res;
	}
	
	public static function getTweetsPostedBy($id, $max = 50) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.tweet
		        WHERE emetteur = " . $id . "
		        ORDER BY id DESC
		        LIMIT " . $max;
		$res = $connection->doQueryObject($sql, "tweet");

		if ($res === false)
			return null;

		return $res;
	}
	
	public static function getTweetById($idTweet) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.tweet WHERE id = " . $idTweet;
		$res = $connection->doQueryObject($sql, "tweet");

		if ($res === false || empty($res))
			return null;

		return $res[0];
	}
	
	public static function getLastTweets($max = 10, $daysDifference = 30) {
	    $dateLimite = strtotime(date("Y-m-d H:i:s") . "-" . $daysDifference . " day");
	    $dateLimite = date("Y-m-d H:i:s", $dateLimite);
	    
		$connection = new dbconnection();
		$sql = "SELECT T.* FROM jabaianb.tweet T
		            INNER JOIN jabaianb.post P ON (T.post = P.id)
		        WHERE P.date >= '" . $dateLimite . "'
		        ORDER BY T.id DESC
		        LIMIT " . $max;
		$res = $connection->doQueryObject($sql, "tweet");

		if ($res === false)
			return null;

		return $res;
	}
	
	public static function getCountLastTweets($startDate) {
		$connection = new dbconnection();
		$sql = "SELECT COUNT(*) FROM jabaianb.tweet T
		            INNER JOIN jabaianb.post P ON (T.post = P.id)
		        WHERE P.date > '" . $startDate . "'";
		$res = $connection->doQuery($sql);

		if ($res === false)
			return null;

		return $res[0]["count"];
	}
}

?>
