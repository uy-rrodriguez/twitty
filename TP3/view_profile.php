<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Détails d'un utilisateur</title>
	<link type="text/css" rel="stylesheet" href="style.php" />
</head>

<body>

<div id="div-centre">

<?php
	if(!isset($_COOKIE["INTERNET_L3_LOGIN"])) {
		echo "<a class='menu' href='private/index.php'>Accueil</a>";
	}
	else {
		echo "<a class='menu' href='index.php'>Accueil</a>";
	}



	require_once("fonctions.php");
	
	/* *** VISUALISATION D'UN UTILISATEUR *** */
	
	$personne = null;
	
	try {
		$id = 0;
		if (isset($_GET["id"]))
			$id = $_GET["id"];
		
		// Connection à la BD
		$conn = connecterBD();
		
		// On cherche une personne
		$personne = obtenirPersonne($conn, $id);
		deconnecterBD($conn);
	}
	catch (Exception $e) {
		die("Error: " . $e->getMessage() . "<br/>");
	}
?>

	<form method="POST" action="#" enctype="multipart/form-data">
		<h1>Détails de la personne</h1>
		<table class="table-horiz">
			<tr>
				<th>Nom</th>
				<td><?php echo $personne->nom; ?><!--<input type="text" id="nom" name="nom" value="" />--></td>
			</tr>
			<tr>
				<th>Prénom</th>
				<td><?php echo $personne->prenom; ?><!--<input type="text" id="prenom" name="prenom" value="" />--></td>
			</tr>
			<tr>
				<th>Avatar</th>
				<td><img width="100px" src="<?php echo $personne->avatar; ?> " alt='Avatar' /></td>
			</tr>
			<tr class="tr-espace"></tr>
			<tr>
				<th>Login</th>
				<td><?php echo $personne->login; ?><!--<input type="text" id="nom" name="nom" value="" />--></td>
			</tr>
		</table>
		
		<input type="hidden" id="id_modifier" name="id_modifier" value="" />
		<input type="hidden" id="vieuxAvatar" name="vieuxAvatar" value="" />
		<input type="hidden" id="id_supprimer" name="id_supprimer" value="0" />
		<input type="hidden" id="action" name="action" value="supprimer" />
	</form>

</div>

</body>

<script type="text/javascript" src="js/fonctions.js"></script>
<!--
<script type="text/javascript">
	creerInputFile("file-text-1", "file-input-1");
</script>
-->

</html> 
