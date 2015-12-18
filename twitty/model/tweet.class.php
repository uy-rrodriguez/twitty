<?php

class tweet extends basemodel
{
	public function getPost() {
		return postTable::getPostById($this->post);
	}
	
	public function getParent() {
		return utilisateurTable::getUserById($this->parent);
	}
	
	public function getLikes() {
		return $this->nbvotes;
	}
	
	/* Retourne les utilisateurs qui ont voté pour le tweet */
	public function getUsersWhoLikeMe() {
		return utilisateurTable::getUsersWhoLikeTweetById($this->id);
	}
}

?>
