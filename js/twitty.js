/* Tout le code li� � AJAX */

function ajaxNouveauTweet() {
	// Obtention des donn�es du formulaire
	var formData = new FormData($("#form-nouveau-tweet")[0]);
	
	// Cr�ation et envoie de l'objet AJAX. Dans ce cas, on envoie le form obtenu, avec l'image d�dans.
	$.ajax({
		url: "twittyAjax.php?action=ajaxNouveauTweet",
		type: "POST",
		data: formData,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function (returnData) {
			// Fonction qui s'ex�cute lors d'une r�ponse de succ�s
			// On ajoute le code du tweet au d�but du div parent
			$("#div-mes-tweets").prepend(returnData);
		}
	});
}

function ajaxPartagerTweet(idTweet) {
	// Cr�ation et envoie de l'objet AJAX
	$.ajax({
		url: "twittyAjax.php?action=ajaxPartagerTweet",
		type: "POST",
		data: {id: idTweet},
		success: function (returnData) {
			// On ajoute le code du tweet au d�but du div parent
			$("#div-mes-tweets").prepend(returnData);
		}
	});
}

function ajaxVoterTweet(idTweet) {	
	// Cr�ation et envoie de l'objet AJAX
	$.ajax({
		url: "twittyAjax.php?action=ajaxVoterTweet",
		type: "POST",
		data: {id: idTweet},
		success: function (returnData) {
			// On modifie la quantit� de votes dans le div associ� a ce tweet
			// On obtient le div, et apr�s on obtient le seul enfant avec la classe "votes"
			$("#div-tweet-" + idTweet).children(".votes").html(returnData);
			
		}
	});
}