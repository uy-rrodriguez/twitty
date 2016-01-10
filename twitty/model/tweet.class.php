<?php

class tweet extends basemodel
{
	public function getPost() {
		return postTable::getPostById($this->post);
	}
	
	public function getParent() {
		return utilisateurTable::getUserById($this->parent);
	}
	
	public function getEmetteur() {
		return utilisateurTable::getUserById($this->emetteur);
	}
	
	public function getLikes() {
	    //$this->nbvotes = voteTable::getCountLikesById($this->id);
		if ($this->nbvotes == null || $this->nbvotes == "")
			return 0;
		else
			return $this->nbvotes;
	}
	
	/* Retourne les utilisateurs qui ont voté pour le tweet */
	public function getUsersWhoLikeMe() {
		return utilisateurTable::getUsersWhoLikeTweetById($this->id);
	}
	
	/* Retourne true si l'utilisateur connecté a déjà voté le tweet */
	public function getDejaVote() {
		return $this->dejaVote;
	}
}

?>
