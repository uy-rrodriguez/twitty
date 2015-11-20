<form method="POST" action="twitty.php?action=myProfil"> <!-- action="twitty.php?action=login" -->
	<table class="table-horiz">
		<tr>
			<th>Identifiant :</th>
			<td><input type="text" name="identifiant" /></td>
		</tr>
		<tr>
			<th>Mot de passe :</th>
			<td><input id="password" type="password" name="password" /></td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2">
				<input type="submit" value="Se connecter" />
			</td>
		</tr>
		<tr class="tr-espace"></tr>
		<tr>
			<td class="td-droite" colspan="2">
				<a class="menu" href="../twitty/TP3/inscription.php">Creer un compte</a>
			</td>
		</tr>
	</table>
</form>
