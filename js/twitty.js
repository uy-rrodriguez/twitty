/* Tout le code lié à AJAX */

function ajaxAfficherMessages() {
	alert("tata");
	// Affichage des messages d'erreur et de succès
	$.ajax({
		url: "twittyAjax.php?action=ajaxMessages",
		type: "POST",
		data: {},
		success: function (returnData) {
			// On obtient le div et on change le contenu
			$("#div-messages").html(returnData);
		}
	});
}

function ajaxNouveauTweet() {
	// Obtention des données du formulaire
	var formData = new FormData($("#form-nouveau-tweet")[0]);
	
	// Création et envoie de l'objet AJAX. Dans ce cas, on envoie le form obtenu, avec l'image dédans.
	$.ajax({
		url: "twittyAjax.php?action=ajaxNouveauTweet",
		type: "POST",
		data: formData,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function (returnData) {
			// Fonction qui s'exécute lors d'une réponse de succès
			// On ajoute le code du tweet au début du div parent
			$("#div-liste-tweets").prepend(returnData);
			
			// On affiche les possibles messages
			ajaxAfficherMessages();
		}
	});
}

function ajaxPartagerTweet(idTweet) {
	// Création et envoie de l'objet AJAX
	$.ajax({
		url: "twittyAjax.php?action=ajaxPartagerTweet",
		type: "POST",
		data: {id: idTweet},
		success: function (returnData) {
			// On ajoute le code du tweet au début du div parent
			$("#div-liste-tweets").prepend(returnData);
			
			// On affiche les possibles messages
			ajaxAfficherMessages();
		}
	});
}

function ajaxVoterTweet(idTweet) {	
	// Création et envoie de l'objet AJAX
	$.ajax({
		url: "twittyAjax.php?action=ajaxVoterTweet",
		type: "POST",
		data: {id: idTweet},
		success: function (returnData) {
			// On modifie la quantité de votes dans le div associé a ce tweet
			// On obtient le div, et après on obtient le seul enfant avec la classe "votes"
			$("#div-tweet-" + idTweet).children(".votes").html(returnData);
			
			//var btnVoter = $("#div-tweet-" + idTweet).children(".btn-voter");
			var btnVoter = $("#btn-voter-" + idTweet);
			btnVoter.html("T'as déjà voté");
			btnVoter.addClass("disabled");
			
			// On affiche les possibles messages
			ajaxAfficherMessages();
		}
	});
}

function ajaxInfos() {
	// Affichage des messages d'information
	$.ajax({
		url: "twittyAjax.php?action=ajaxInfos",
		type: "POST",
		data: {},
		success: function (returnData) {
			// On obtient le div et on change le contenu
			$("#div-infos").html(returnData);
		}
	});
}


// On crée un timer qui affichera les messages tous les n minutes
$(document).ready( function() {
	setInterval(function() {ajaxInfos();}, 3000);
});
