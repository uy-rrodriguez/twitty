<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="author" content="GARAYT Thomas UAPV1602799 & RODRIGUEZ Ricardo UAPV1601663" />
	<meta name="description" content="" />
	<link type="text/css" rel="stylesheet" href="style.php" />
	<title>Inscription</title>
</head>

<body>
	<form method="POST" action="inserer.php" enctype="multipart/form-data">
		<div id="div-centre">
			<h1>Créer personne</h1>
			<table class="table-horiz">
				<tr>
					<th>Prénom:</th>
					<td><input type="text" name="prenom" /></td>
				</tr>
				<tr>
					<th>Nom:</th>
					<td><input type="text" name="nom" /></td>
				</tr>
				<tr>
					<th>Login:</th>
					<td><input type="text" name="identifiant" /></td>
				</tr>
				<tr>
					<th>Mot de passe:</th>
					<td><input id="password" type="password" name="password" /></td>
				</tr>
				<tr>
					<th>Avatar:</th>
					<td>
						<label class="input-file-container">
							Fichiers...
							<input type="text" id="text-file-1" class="input-file-text" disabled />
							<input type="file" id="input-file-1" name="avatar" accept=".png,.jpg,.bmp" />
						<label>
					</td>
				</tr>
				<tr class="tr-espace"></tr>
				<tr>
					<td class="td-droite" colspan="2"><input type="submit" value="Inscris moi!" /></td>
				</tr>
			</table>
		</div>
	</form>

</body>

<script type="text/javascript" src="js/fonctions.js"></script>
<script type="text/javascript">
	creerInputFile("text-file-1", "input-file-1");
</script>

</html> 
