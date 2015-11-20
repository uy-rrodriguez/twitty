<h1>Mon profil public</h1>
<form method="POST" action="#" enctype="multipart/form-data">
	<table class="table-horiz">
		<tr>
			<th>Statut : </th>
			<td><input type="text" name="identifiant" value="J'aime les aubergines!!!"/></td>
		</tr>
		<tr>
			<th>Prénom : </th>
			<td><input type="text" name="prenom" value="Bob"/></td>
		</tr>
		<tr>
			<th>Nom : </th>
			<td><input type="text" name="nom" value="Le bricoleur"/></td>
		</tr>
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
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>

<form method="POST" action="#" enctype="multipart/form-data">
	<h1>Mes paramètres de sécurité</h1>
	<table class="table-horiz">
		<tr>
			<th>Mot de passe:</th>
			<td><input id="password" type="password" name="password" value ="monMotDePasse"/></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Sauvegarder" /></td>
		</tr>
	</table>
</form>