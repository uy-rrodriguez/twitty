<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Modification de profil</title>
	<link type="text/css" rel="stylesheet" href="../style.php" />
</head>

<body>

<div id="div-centre">
	<a class="menu" href="index.php">Accueil</a>

<?php
	require_once("../fonctions.php");
	
	/* *** MODIFICATION DE PROFIL *** */
	
	$id = 0;
	if (isset($_REQUEST["id"])) {
		$id = $_REQUEST["id"];
	}
	
	try {
		// Connection à la BD
		$conn = connecterBD();
		
		$action = "";
		if (isset($_REQUEST["action"])) {
			$action = $_REQUEST["action"];
		}
		
		switch ($action) {
			case "modifier":
				if (! isset($_REQUEST["prenom"])
					|| ! isset($_REQUEST["nom"])
					|| $_REQUEST["prenom"] == ""
					|| $_REQUEST["nom"] == "") {

					echo "Vous n'avez pas bien saisi les données! <br />";
				}
				else {
					// Téléchargement de l'image, si on a reçu une nouvelle image
					if ($_FILES["avatar"]["tmp_name"] != "")
						$path = telechargerAvatar();
					else
						$path = $_REQUEST["vieuxAvatar"];
					
					$p = new Personne($_REQUEST["nom"], $_REQUEST["prenom"], $path, "", "", $_REQUEST["id"]);
					modifierPersonne($conn, $p);
				}
				
				break;
		}
		
		// On liste les personnes
		$p = obtenirPersonne($conn, $id);
		deconnecterBD($conn);
	}
	catch (Exception $e) {
		die("Error: " . $e->getMessage() . "<br/>");
	}
?>

	<form method="POST" action="modify_profile.php" enctype="multipart/form-data">
		<h1>Modifier personne</h1>
		<table class="table-horiz">
			<tr>
				<th>Nom</th>
				<td><input type="text" id="nom" name="nom" value="<?php echo $p->nom; ?>" /></td>
			</tr>
			<tr>
				<th>Prénom</th>
				<td><input type="text" id="prenom" name="prenom" value="<?php echo $p->prenom; ?>" /></td>
			</tr>
			<tr>
				<th>Avatar</th>
				<td>
					<label class="input-file-container">
						Fichiers...
						<input id="file-text-1" type="text" class="input-file-text" disabled />
						<input id="file-input-1" type="file" name="avatar" accept=".png,.jpg,.bmp" />
					<label>
				</td>
			</tr>
			<tr class="tr-espace"></tr>
			<tr>
				<td colspan="2" class="td-droite">
					<input type="submit" value="Envoyer" />
				</td>
			</tr>
			<tr>
				<td colspan="2" class="td-droite">
					<input type="button" class="btn-secondaire" value="Annuler" onclick="window.location='private/index.php';" />
				</td>
			</tr>
		</table>
		
		<input type="hidden" id="vieuxAvatar" name="vieuxAvatar" value="" />
		<input type="hidden" name="id" value="<?php echo $p->id; ?>" />
		<input type="hidden" id="action" name="action" value="modifier" />
	</form>

</div>

</body>

<script type="text/javascript" src="../js/fonctions.js"></script>
<script type="text/javascript">
	creerInputFile("file-text-1", "file-input-1");
</script>

</html> 
