<?php

class tweetTable
{
	public static function getVotesByTweetId($tweetId) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.vote WHERE tweet = " . $tweetId;
		$res = $connection->doQueryObject( $sql, "vote" );

		if($res === false)
			return false ;

		return $res ;
	}
}

?>