<h1>Mon réseau</h1>
<table class="table-horiz table-vert">
		<tr>
			<th></th>
			<th>Prénom</th>
			<th>Nom</th>
		</tr>
		
<?php
    // On obtient la liste d'utilisateurs du réseau, qui devrait être dans la session.
    // Pour chaque objet, on affiche des données basiques
    $mesAmis = context::getSessionAttribute("mesAmis");
    
    if (empty($mesAmis))
        echo "Tu n'as aucun ami.";
        
    else
	    foreach ($mesAmis as $u) {
?>
		    <tr class="tr-link" onClick="document.location.href='twitty.php?action=voirProfil&id=<?php echo $u->id; ?>'">
			    <td><img width="40px" src="img/profil/<?php echo $u->avatar; ?>" /></td>
			    <td><?php echo $u->prenom; ?></td>
			    <td><?php echo $u->nom; ?></td>
		    </tr>
<?php
	    }
?>

</table>
