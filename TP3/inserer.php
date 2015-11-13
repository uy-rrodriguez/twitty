<?php 
	require_once("fonctions.php");

	try {
		// Connection à la BD
		$conn = connecterBD();

		if (! isset($_REQUEST["prenom"])
			|| ! isset($_REQUEST["nom"])
			|| ! isset($_REQUEST["identifiant"])
			|| $_REQUEST["prenom"] == ""
			|| $_REQUEST["nom"] == ""
			|| $_REQUEST["identifiant"] == "") {

			echo "Vous n'avez pas bien saisi les données! <br />";
		}
		else {
			// Téléchargement de l'image
			$path = telechargerAvatar("avatar");
			$u = new Utilisateur(	$_REQUEST["identifiant"],
									$_REQUEST["password"],
									$_REQUEST["nom"],
									$_REQUEST["prenom"],
									"",
									$path);
			$u->pass = sha1($u->pass);
			insererUtilisateur($conn, $u);
			
			echo "L'utilisateur a bien été créé ! <br />";
		}
		deconnecterBD($conn);
	}
	catch (Exception $e) {
		echo "Erreur: " . $e->getMessage() . "<br/>" ;
	}
?>
<a href="../monApplication.php">Accueil</a>
