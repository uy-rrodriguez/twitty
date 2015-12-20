<?php

class voteTable
{
    public static function getCountLikesById($tweetId) {
		$connection = new dbconnection();
		$sql = "SELECT COUNT(*) FROM jabaianb.vote WHERE message = " . $tweetId;
		$res = $connection->doQuery($sql);

		if ($res === false || empty($res) || ! is_int($res[0]))
			return 0;

		return $res[0];
    }
    
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
