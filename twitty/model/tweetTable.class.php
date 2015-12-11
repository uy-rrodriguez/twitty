<?php

class tweetTable
{
	public static function getTweets() {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.tweet" ;
		$res = $connection->doQueryObject( $sql, "tweet" );

		if($res === false)
			return false ;

		return $res ;
	}
	
	public static function getTweetsPostedBy($id) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.tweet WHERE emetteur = " . $id;
		$res = $connection->doQueryObject( $sql, "tweet" );

		if($res === false)
			return false ;

		return $res ;
	}
}

?>