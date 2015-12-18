<?php

class tweetTable
{
	public static function getVotesByTweetId($tweetId) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.vote WHERE message = " . $tweetId;
		$res = $connection->doQueryObject($sql, "vote");

		if ($res === false || empty($res))
			return null;

		return $res;
	}
}

?>
