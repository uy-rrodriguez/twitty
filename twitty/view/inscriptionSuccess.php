<h1>Inscription</h1>
<form method="post" action="twitty.php?action=finInscription">
	<table class="table-horiz">
		<tr>
			<th>Identifiant : </th>
			<td><input type="text" name="identifiantInscrip" /></td>
		</tr>
		<tr>
			<th>Password : </th>
			<td><input type="password" name="passInscrip" /></td>
		</tr>
		<tr>
			<th>Prénom : </th>
			<td><input type="text" name="prenomInscrip" /></td>
		</tr>
		<tr>
			<th>Nom : </th>
			<td><input type="text" name="nomInscrip" /></td>
		</tr>

		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2"><input type="submit" value="Inscris-moi!" /></td>
		</tr>

		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2">
				<a class="menu" href="twitty.php?action=login">Annuler</a>
			</td>
		</tr>
	</table>
</form>
