function supprimerPersonne(id) {
	document.getElementById("id_supprimer").value = id;
}

function chargerChampsPersonne(id, nom, prenom, avatar) {
	with (document) {
		getElementById("id_modifier").value = id;
		getElementById("nom").value = nom;
		getElementById("prenom").value = prenom;
		getElementById("vieuxAvatar").value = avatar;
		
		getElementById("div-modifier-personne").style.display = "block";
	}
}

function modifierPersonne() {
	with (document) {
		getElementById("action").value = "modifier";
		forms[0].submit();
	}
}

function nettoyerChampsPersonne() {
	with (document) {
		getElementById("id_modifier").value = "";
		getElementById("nom").value = "";
		getElementById("prenom").value = "";
		getElementById("vieuxAvatar").value = "";
		
		getElementById("div-modifier-personne").style.display = "none";
	}
}

function creerInputFile(idInputText, idInputFile) {
	var text = document.getElementById(idInputText);
	var file = document.getElementById(idInputFile);
	file.onchange = function (evt) {
		text.value = "../" + file.value;
	}
}

function crypterPassword() {
	var input = document.getElementById("password");
	input.value = hex_md5(input.value);
}