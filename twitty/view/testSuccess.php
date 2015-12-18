<?php

	if (key_exists("reponse", $_SESSION)) {
	    $rep = context::getSessionAttribute("reponse");
	    
	    if (! is_null($rep) && is_array($rep)) {
	        foreach($rep as $data) {
	            echo "<h1> " . $data . " </h1>";
	        }
	    }
	    else {
    		echo "<h1> " . $rep . " </h1>";
    	}
	}
?>

<h1>Test utilisateur</h1>
<form method="POST" action="twitty.php?action=test&nomTest=testUtilisateur" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Identifiant : </th>
			<td><input type="text" name="identifiant" value="Bob"/></td>
		</tr>
		<tr>
			<th>Password : </th>
			<td><input type="text" name="pass" value="1"/></td>
		</tr>
		<tr>
			<th>Nom : </th>
			<td><input type="text" name="nom" value="Le bricoleur"/></td>
		</tr>
		<tr>
			<th>Prénom : </th>
			<td><input type="text" name="prenom" value="Bob"/></td>
		</tr>
		<tr>
			<th>Statut : </th>
			<td><input type="text" name="statut" value="J'aime les aubergines!!!"/></td>
		</tr>
		<!--
		<tr>
			<th>Avatar : </th>
			<td>
				<label class="input-file-container">
					Fichiers...
					<input type="text" id="text-file-1" class="input-file-text" disabled />
					<input type="file" id="input-file-1" name="avatar" accept=".png,.jpg,.bmp" />
				</label>
			</td>
		</tr>
		-->
		
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>

<h1>Test tweet</h1>
<form method="POST" action="twitty.php?action=test&nomTest=testTweet" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Id Emetteur :</th>
			<td><input type="text" name="emetteur" value="1"/></td>
		</tr>
		<tr>
			<th>Id Parent :</th>
			<td><input type="text" name="parent" value="1"/></td>
		</tr>
		<tr>
			<th>Id Post :</th>
			<td><input type="text" name="post" value="1"/></td>
		</tr>
		<tr>
			<th>Nombre votes :</th>
			<td><input type="text" name="nbVotes" value="0"/></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>

<h1>Test post</h1>
<form method="POST" action="twitty.php?action=test&nomTest=testPost" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Texte :</th>
			<td><input type="text" name="texte" value="1"/></td>
		</tr>
		<tr>
			<th>Date :</th>
			<td><input type="text" name="date" value="10/12/2015"/></td>
		</tr>
		<tr>
			<th>Image :</th>
			<td><input type="text" name="image" value=""/></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>

<h1>Test GET Post</h1>
<form method="POST" action="twitty.php?action=test&nomTest=testTweetGetPost" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Id Tweet :</th>
			<td><input type="text" name="tweet" value="1"/></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>

<h1>Test GET Parent</h1>
<form method="POST" action="twitty.php?action=test&nomTest=testTweetGetParent" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Id Tweet :</th>
			<td><input type="text" name="tweet" value="1"/></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>

<h1>Test GET Nombre votes</h1>
<form method="POST" action="twitty.php?action=test&nomTest=testTweetGetLikes" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Id Tweet :</th>
			<td><input type="text" name="tweet" value="1"/></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>

<h1>Test GET Utilisateurs votes</h1>
<form method="POST" action="twitty.php?action=test&nomTest=testTweetGetUtilisateursVotes" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Id Tweet :</th>
			<td><input type="text" name="tweet" value="1"/></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>
