<?php
	if(!isset($_COOKIE["INTERNET_L3_LOGIN"])) {
		require_once("verif_login.php");
	}
	else {
		$donnees = explode(":", $_COOKIE["INTERNET_L3_LOGIN"]);
		$idPersonne = $donnees[0];
	}
	
	require_once("../fonctions.php");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="author" content="GARAYT Thomas UAPV1602799 & RODRIGUEZ Ricardo UAPV1601663" />
	<meta name="description" content="Première page qui permet de voir la liste d'utilisateurs" />
	<link type="text/css" rel="stylesheet" href="../style.php" />
	<title>Accueil</title>
</head>

<body>

<div id="div-centre">

<?php
	/* *** LISTE DES UTILISATEURS *** */
	$listePersonnes = null;
	
	try {
		// Connection à la BD
		$conn = connecterBD();
		
		// Personne connecté
		$personne = obtenirPersonne($conn, $idPersonne);
		
		// On liste les personnes
		$listePersonnes = obtenirPersonnes($conn);
		deconnecterBD($conn);
	}
	catch (Exception $e) {
		die("Error: " . $e->getMessage() . "<br/>");
	}
?>

	<h1>Bienvenue <?php echo $personne->prenom . " " . $personne->nom; ?> !</h1>
	<br />
	
	<h1>Liste des utilisateurs</h1>
	<table class="table-vert">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Avatar</th>
			</tr>
		</thead>
<?php
		foreach($listePersonnes as $p) {
			$id_nom = "nom_" . $p->id;
			$id_prenom = "prenom_" . $p->id;
			
			$pageDestin = "../view_profile.php?id=" . $p->id;
			if ($p->id == $personne->id) {
				$pageDestin = "modify_profile.php?id=" . $p->id;
			}
?>
			<tr class="tr-link" onclick="window.location='<?php echo $pageDestin; ?>'">
				<td><?php echo $p->id; ?></td>
				<td><?php echo $p->nom; ?></td>
				<td><?php echo $p->prenom; ?></td>
				<td><img width="30px" src="../<?php echo $p->avatar; ?> " alt='Avatar' /></td>
			</tr>
<?php
		}
?>
	</table>

</div>

</body>
<!--
<script type="text/javascript" src="../js/fonctions.js"></script>
<script type="text/javascript">
	creerInputFile("file-text-1", "file-input-1");
</script>
-->
</html> 
