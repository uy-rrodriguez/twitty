/* ********************************************************************************* */
/*                      CODE JAVASCRIPT DE TOUTE L'APPLICATION                       */
/* ********************************************************************************* */


/* ************************************* AJAX ************************************** */

// Wrapper pour les fonctions qui envoyent des requêtes AJAX
function ajaxCall(pUrl, pData, successCallback,
                    pContentType = "application/x-www-form-urlencoded; charset=UTF-8",
                    pProcessData = true, pAsync = true) {

    // On change le pointeur pour montrer qu'on est en train d'envoyer une requête
    $("body").css("cursor", "wait");

    // Création et envoie de l'objet AJAX.
    $.ajax({
		url: pUrl,
		type: "POST",
		data: pData,

		contentType: pContentType,
		async: pAsync,
		processData: pProcessData,

		success: function (returnData) {
            // Fonction qui s'exécute lors d'une réponse de succès
			successCallback(returnData);

			$("body").css("cursor", "default");

			// On affiche les possibles messages
			ajaxAfficherMessages();
		}
	});
}

// Fonction pour afficher des messages après l'exécution de certaines actions
function ajaxAfficherMessages() {
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

// Fonction pour l'affichage des messages d'information
function ajaxInfos() {
	$.ajax({
		url: "twittyAjax.php?action=ajaxInfos",
		type: "POST",
		data: {},
		success: function (returnData) {
			// On obtient le div et on change le contenu
			$("#div-bulle-infos-container").html(returnData);
		}
	});
}

// Fonction pour créer un tweet
function ajaxNouveauTweet() {
	// Obtention des données du formulaire
	var formData = new FormData($("#form-nouveau-tweet")[0]);

	// Dans ce cas, on envoie le form obtenu, avec l'image dédans.
	ajaxCall("twittyAjax.php?action=ajaxNouveauTweet",
	            formData,
	            function (returnData) {
			        // On ajoute le code du tweet au début du div parent
			        $("#div-liste-tweets").prepend(returnData);
			    },
                pContentType = false,
                pProcessData = false);
}

// Fonction pour partager un tweet
function ajaxPartagerTweet(idTweet) {
    ajaxCall("twittyAjax.php?action=ajaxPartagerTweet",
                {id: idTweet},
                function (returnData) {
			        // On ajoute le code du tweet au début du div parent
			        $("#div-liste-tweets").prepend(returnData);
			    });
}

// Fonction pour voter un tweet
function ajaxVoterTweet(idTweet) {
    ajaxCall("twittyAjax.php?action=ajaxVoterTweet",
                {id: idTweet},
                function (returnData) {
			        // On modifie la quantité de votes dans le div associé a ce tweet
			        // On obtient le div, et après on obtient le seul enfant avec la classe "votes"
			        $("#div-tweet-" + idTweet).children(".votes").html(returnData);

			        //var btnVoter = $("#div-tweet-" + idTweet).children(".btn-voter");
			        var btnVoter = $("#btn-voter-" + idTweet);
			        btnVoter.html("T'as déjà voté");
			        btnVoter.addClass("disabled");
			    });
}

// Fonction pour modifier le profil
function ajaxEnregistrerProfil() {
	// Obtention des données du formulaire
	var formData = new FormData($("#form-profil")[0]);

    ajaxCall("twittyAjax.php?action=ajaxEnregistrerProfil",
                formData,
                function (returnData) {
                    // On modifie le div avec le profil
			        $("#div-petit-profil").html(returnData);
			    },
                pContentType = false,
                pProcessData = false);
}

// Fonction pour modifier les paramètres de sécurité
function ajaxEnregistrerSecurite() {
	// Obtention des données du formulaire
	var formData = new FormData($("#form-securite")[0]);

    ajaxCall("twittyAjax.php?action=ajaxEnregistrerSecurite",
                formData,
                function (returnData) {
                    // On ne fait rien. Un message devrait s'afficher en bas de l'entête
			    },
                pContentType = false,
                pProcessData = false);
}



/* ********************************* Autres fonctions utilisées ******************** */

// On crée un timer qui affichera les messages tous les 5 secondes
$(document).ready( function() {
	setInterval(function() {ajaxInfos();}, 5000);
});


// Code pour les input file qu'on a personnalisé
$(document).ready( function() {
    // Noter que tous les input file doivent avoir un id de la forme: input-file-#
    // et les input text associés: input-file-text-#
    // # étant le numéro qui permet de les associer
    //
    // Noter aussi que tous les input file doivent avoir une classe: input-file

    // On cherche tous les input file de la page
    var inputsFile = document.querySelectorAll("input.input-file");

    for (var i = 0 ; i < inputsFile.length ; i++) {
        var file = inputsFile[i];
        var numero = file.id.split("input-file-")[1];
        var text = document.getElementById("input-file-text-" + numero);

        // On associe les input. Quand le file change, le text affiche le contenu
        file.onchange = new Function("evt",
            "document.getElementById('" + text.id + "').value = '../' + this.value;");
    }
});


// Script pour l'effet de réduction de taille de l'entête quand on scrolle la page
window.onscroll = function() {
    var tete = document.getElementById("div-tete");
    var centre = document.getElementById("div-centre");
    if (window.pageYOffset > 50) {
        tete.className = "on-scroll";
        centre.className = "on-scroll";
    }
    else {
        tete.className = "";
        centre.className = "";
    }
};

$(document).ready( function() {
    window.onscroll();
});

