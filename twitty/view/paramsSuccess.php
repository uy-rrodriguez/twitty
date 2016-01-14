<h1>Mon profil public</h1>
<form id="form-profil" method="post" action="twitty.php?action=params&enregistrerProfil" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Statut :</th>
			<td><input type="text" name="statut" value="<?php echo $moi->statut; ?>"
			        placeholder="Ajouter un statut, c'est malin!" /></td>
		</tr>
		<tr>
			<th>Prénom :</th>
			<td><input type="text" name="prenom" value="<?php echo $moi->prenom; ?>" /></td>
		</tr>
		<tr>
			<th>Nom : </th>
			<td><input type="text" name="nom" value="<?php echo $moi->nom; ?>"/></td>
		</tr>
		<tr>
			<th>Avatar :</th>
			<td>
				<label class="input-file-container">
					Avatar...
					<input type="text" id="input-file-text-1" class="input-file-text" disabled
					    placeholder="Cliques ici pour le changer" />
					<input type="file" id="input-file-1" class="input-file" name="avatar" accept=".png,.jpg,.bmp" />
				</label>
			</td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2">
                <input type="button" value="Sauvegarder" onclick="ajaxEnregistrerProfil()" />
            </td>
		</tr>
	</table>
</form>

<form id="form-securite" method="POST" action="twitty.php?action=params&enregistrerSecurite" enctype="multipart/form-data">
	<h1>Mes paramètres de sécurité</h1>
	<table class="table-horiz">
		<tr>
			<th>Mot de passe actuel :</th>
			<td><input id="passwordActuel" type="password" name="passwordActuel" /></td>
		</tr>
		<tr>
			<th>Nouveau mot de passe :</th>
			<td><input id="passwordNouveau" type="password" name="passwordNouveau" /></td>
		</tr>
		<tr>
			<th>Répéter mot de passe :</th>
			<td><input id="passwordRepete" type="password" name="passwordRepete" /></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2">
                <input type="button" value="Sauvegarder" onclick="ajaxEnregistrerSecurite()" />
            </td>
		</tr>
	</table>
</form>
