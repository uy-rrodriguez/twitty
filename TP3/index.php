<!DOCTYPE html>
<?php
	require_once("fonctions.php");
?>

<html>

<head>
	<meta charset="UTF-8" />
	<meta name="author" content="GARAYT Thomas UAPV1602799 & RODRIGUEZ Ricardo UAPV1601663" />
	<meta name="description" content="Première page qui permet de voir la liste d'utilisateurs" />
	<link type="text/css" rel="stylesheet" href="style.php" />
	<title>Accueil</title>
</head>

<body>

<div id="div-centre">

<?php
	/* *** POSSIBLE ERREUR DE CONNECTION *** */
	if (isset($_GET["erreurLogin"]))
		echo "Login ou mot de passe incorrect." . "<br/>";
	
	/* *** LISTE DES UTILISATEURS *** */
	
	$listePersonnes = null;
	
	try {
		// Connection à la BD
		$conn = connecterBD();
		
		$action = "";
		if (isset($_REQUEST["action"])) {
			$action = $_REQUEST["action"];
		}
		
		switch ($action) {
			case "inserer":
				if (! isset($_REQUEST["prenom"])
					|| ! isset($_REQUEST["nom"])
					|| ! isset($_REQUEST["login"])
					|| $_REQUEST["prenom"] == ""
					|| $_REQUEST["nom"] == ""
					|| $_REQUEST["login"] == "") {

					echo "Vous n'avez pas bien saisi les données! <br />";
				}
				else {
					// Téléchargement de l'image
					$path = telechargerAvatar("avatar");
					$p = new Personne($_REQUEST["nom"], $_REQUEST["prenom"], $path, $_REQUEST["login"], $_REQUEST["password"]);
					insererPersonne($conn, $p);
				}
				
				break;
		}
		
		// On liste les personnes
		$listePersonnes = obtenirPersonnes($conn);
		deconnecterBD($conn);
	}
	catch (Exception $e) {
		die("Erreur: " . $e->getMessage() . "<br/>");
	}
?>

	<div>
		<form method="POST" action="private/index.php" onsubmit="crypterPassword();">
			<table class="table-horiz">
				<tr>
					<th>Login:</th>
					<td><input type="text" name="login" /></td>
				</tr>
				<tr>
					<th>Password:</th>
					<td><input id="password" type="password" name="password" /></td>
				</tr>
				<tr>
					<th></th>
					<td><input type="checkbox" value="1" name="seSouvenir" /> <span class="texte-petit">Se souvenir de moi</span></td>
				</tr>
				<tr class="tr-espace"></tr>
				<tr>
					<td class="td-droite" colspan="2">
						<input type="submit" value="Se connecter" />
					</td>
				</tr>
				<tr class="tr-espace"></tr>
				<tr>
					<td class="td-droite" colspan="2"><a class="menu" href="inscription.php">Creer un compte</a></td>
				</tr>
			</table>
		</form>
	</div>
	
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
?>
			<tr class="tr-link" onclick="window.location='view_profile.php?id=<?php echo $p->id; ?>';">
				<td><?php echo $p->id; ?></td>
				<td><?php echo $p->nom; ?></td>
				<td><?php echo $p->prenom; ?></td>
				<td><img width="30px" src="<?php echo $p->avatar; ?> " alt='Avatar' /></td>
			</tr>
<?php
		}
?>
	</table>

</div>

</body>

<script type="text/javascript" src="js/md5.js"></script>
<script type="text/javascript" src="js/fonctions.js"></script>

<!--
<script type="text/javascript">
	creerInputFile("file-text-1", "file-input-1");
</script>
-->
</html> 
