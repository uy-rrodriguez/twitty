<?php

class voteTable
{
	public static function getVotesByTweetId($tweetId) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.vote WHERE message = " . $tweetId;
		$res = $connection->doQueryObject($sql, "vote");

		if ($res === false)
			return null;

		return $res;
	}
	
	public static function getVoteByTweetAndUser($tweetId, $userId) {
		$connection = new dbconnection();
		$sql = "SELECT * FROM jabaianb.vote WHERE message = " . $tweetId . " AND utilisateur = " . $userId;
		$res = $connection->doQueryObject($sql, "vote");

		if ($res === false || empty($res))
			return null;

		return $res[0];
	}

    public static function getCountLikesById($tweetId) {
		$connection = new dbconnection();
		$sql = "SELECT COUNT(*) FROM jabaianb.vote WHERE message = " . $tweetId;
		$res = $connection->doQuery($sql);

		if ($res === false)
			return 0;

		return $res[0]["count"];
    }
}

?>
