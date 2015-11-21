<h1>Mon réseau</h1>
<table class="table-horiz table-vert">
		<tr>
			<th></th>
			<th>Nom</th>
			<th>Prénom</th>
		</tr>
		
<?php
    $reseau = array();
    for ($i = 1; $i < 6 ; $i++)
        array_push($reseau, ["Prénom $i", "Nom $i"]);
    
    foreach ($reseau as $u) {
?>
		<tr class="tr-link" onClick="document.location.href='twitty.php?action=voirProfil&id=1'">
			<td><img width="40px" src="img/profil.png" /></td>
			<td><?php echo $u[0]; ?></td>
			<td><?php echo $u[1]; ?></td>
		</tr>
<?php
    }
?>

</table>
