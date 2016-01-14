<?php

class tweet extends basemodel
{
	public function getPost() {
        try {
		    return postTable::getPostById($this->post);
	    }
        catch (Exception $e) {
            //context::setSessionAttribute("erreur", $e);
            return new post();
        }
	}

	public function getParent() {
        try {
		    return utilisateurTable::getUserById($this->parent);
	    }
        catch (Exception $e) {
            //context::setSessionAttribute("erreur", $e);
            return new utilisateur();
        }
	}

	public function getEmetteur() {
        try {
		    return utilisateurTable::getUserById($this->emetteur);
	    }
        catch (Exception $e) {
            //context::setSessionAttribute("erreur", $e);
            return new utilisateur();
        }
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
