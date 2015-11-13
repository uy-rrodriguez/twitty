<?php
	class Utilisateur {
		public $id;
		public $identifiant;
		public $pass;
		public $nom;
		public $prenom;
		public $statut;
		public $avatar;
		
		function __construct(
						 $identifiant = NULL,
						 $pass = NULL,
						 $nom = NULL,
						 $prenom = NULL,
						 $statut = NULL,
						 $avatar = NULL, 
						 $id = NULL) {
							 
			if ($id != NULL)
				$this -> id = $id;
			if ($nom != NULL)
				$this -> nom = $nom;
			if ($prenom != NULL)
				$this -> prenom = $prenom;
			if ($avatar != NULL)
				$this -> avatar = $avatar;
			if ($identifiant != NULL)
				$this -> identifiant = $identifiant;
			if ($pass != NULL)
				$this -> pass = $pass;
			if ($statut != NULL)
				$this -> statut = $statut;
		}
	}

	function connecterBD() {
		$conn = new PDO("pgsql:host=localhost;dbname=etd", "uapv1602799", "cFHJEJ");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
	
	function deconnecterBD(&$conn) {
		$conn = null;
	}
	
	function insererUtilisateur($conn, $u) {
		$sql = "INSERT INTO jabaianb.utilisateur (identifiant, pass, nom, prenom, statut, avatar) VALUES (?, ?, ?, ?, ?, ?)";
		
		$stm = $conn->prepare($sql);

		if ($stm->execute(array($u->identifiant, $u->pass, $u->nom, $u->prenom, $u->statut, $u->avatar))) {
			$stm->closeCursor();
		}
		else {
			$info = $stm->errorInfo();
			$stm->closeCursor();
			throw new Exception("Il y a eu une erreur pour créer l'utilisateur. Code : " . $info[0] . ". Message : " . $info[2]);
		}
	}	
	
	function telechargerAvatar() {
		// Code pour télécharger une image
		$repertoire = "avatars/";
		$fichier = $_FILES["avatar"];
		$path_fichier = $repertoire . basename($fichier["name"]);

		$typeFichier = pathinfo($path_fichier, PATHINFO_EXTENSION);

		if (! move_uploaded_file($fichier["tmp_name"], $path_fichier)) {
			return "Erreur";
		}
		else {
			return $repertoire . $fichier["name"];
		}
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function obtenirPersonne($conn, $id) {
		$sql = "SELECT * FROM utilisateur WHERE id = ?";
		
		$stm = $conn->prepare($sql);

		if ($stm->execute(array($id))) {
			$p = $stm->fetchObject("Personne");
			$stm->closeCursor();
			return $p;
		}
		else {
			$info = $stm->errorInfo();
			$stm->closeCursor();
			//print_r($info);
			throw new Exception("Il y a eu une erreur pour obtenir la personne.");
		}
	}
	
	function checkLogin($conn, $login, $password) {
		$sql = "SELECT * FROM utilisateur WHERE login = ? AND password = ?";
		
		$stm = $conn->prepare($sql);

		if ($stm->execute(array($login, $password))) {
			$p = $stm->fetchObject("Personne");
			$stm->closeCursor();
			return $p;
		}
		else {
			$info = $stm->errorInfo();
			$stm->closeCursor();
			//print_r($info);
			throw new Exception("Il y a eu une erreur pour obtenir la personne.");
		}
	}
	
	function obtenirPersonnes($conn) {
		$liste = array();
		$res = $conn->query("SELECT * FROM utilisateur ORDER BY id");
		if ($res) {
			foreach ($res as $ligne) {
				$p = new Utilisateur($ligne["nom"], $ligne["prenom"], $ligne["avatar"], $ligne["login"], $ligne["password"], $ligne["id"]);
				array_push($liste, $p);
			}
			return $liste;
		}
		else {
			throw new Exception("Il y a eu une erreur pour obtenir toutes les personnes");
		}
	}

	function modifierPersonne($conn, $personne) {
		$sql = "UPDATE utilisateur SET " .
						"nom = ?, " .
						"prenom = ?, " .
						"avatar = ? " .
						"WHERE id = ?";
		
		$stm = $conn->prepare($sql);

		if ($stm->execute(array($personne->nom, $personne->prenom, $personne->avatar, $personne->id))) {
			$stm->closeCursor();
		}
		else {
			$info = $stm->errorInfo();
			$stm->closeCursor();
			print_r($info);
			throw new Exception("Il y a eu une erreur pour modifier la personne.");
		}
	}
	
	function supprimerPersonne($conn, $id) {
		return $conn->query("DELETE FROM utilisateur WHERE id = " . $id);
	}
	

?>