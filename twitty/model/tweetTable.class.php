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
	
	public static function getTweetsPostedBy($id) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.tweet WHERE emetteur = " . $id . " ORDER BY id DESC";
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
}

?>
