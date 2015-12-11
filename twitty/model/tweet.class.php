<?php

class tweet extends basemodel
{
	public function getPost() {
		return postTable::getPostById($this->post);
	}
	
	public function getParent() {
		return userTable::getUserById($this->parent);
	}
	
	public function getLikes() {
		return $this->nbVotes;
	}
	
	/* Retourne les utilisateurs qui ont voté pour le tweet */
	public function getUsersWhoLikeMe() {
		return utilisateurTable::getUsersWhoLikeTweetById($this->id);
	}
}

?>