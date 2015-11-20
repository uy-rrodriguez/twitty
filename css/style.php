<?php
header("content-type:text/css");

/* http://www.color-hex.com/color-palette/11032 */
$cTexte = "#474747";
$cPrincipal = "#5c8198";
$cLiens = "#0d2158";
$cSecondaire = "#bacecc";
$cFond = "#dddddd";
$cFondClair = "#F9F9F9";
$cTexteClair = "#FFFFFF";


echo <<<FINCSS


/* ************************************************************************************************
 *     QUELQUES STYLES GÉNERALES ET POUR LA STRUCTURE
 * ************************************************************************************************ */

body {
	/*background-color: $cFondClair;*/
	font-family: Verdana, sans-serif;
	font-size: 13px;
	color: $cTexte;
}

div, span, table, tr, th, td, input, label {
	box-sizing: border-box;
}

a.menu {
	padding: 0px 10px;
	color: $cSecondaire;
	text-decoration: none;
	border: 1px solid $cSecondaire;
	border-top: 0px;
	border-bottom: 0px;
}
a.menu:hover {
	color: $cLiens;
	border-color: $cLiens;
}

span.texte-petit {
	font-size: 10px;
}

#div-centre {
	position: relative;
	margin: 50px auto;
	width: 900px;
	min-height: 500px;
	padding: 15px 40px 0px 40px;
	border: 1px solid $cFond;
	border-radius: 10px;
	/*background-color: $cFondClair;*/
	border-color: $cSecondaire;
}

/* ************** TETE ************** */
#div-tete {
  display: table;
  width: 100%;
  height: 60px;
}

#div-menu {
  display: table-cell;
}

#menu {
  float: right;
  margin: 0px;
  padding: 0px;
}

#menu li {
border-radius: 5px 5px 5px 5px;
  display: inline-block;
  list-style-type: none;
  
  padding: 5px 20px;
  background-color: $cFond;
}

#menu li:hover {
  display: inline-block;
  list-style-type: none;
  
  padding: 5px 20px;
  background-color: $cPrincipal;
}

#menu li a {
  color: $cTexte;
  text-decoration: none;
}

#menu li#item-active {
	background-color: $cPrincipal;
}

#menu li#item-active a {
  color: $cTexteClair;
}

/* ************** AFFICHAGE DU PETIT PROFIL ************** */
#div-petit-profil {
  /*width: 300px;*/
}

#div-petit-profil table {
  margin: 0px;
  /*width: 100%;*/
}
/*
#div-petit-profil table tr td:last-child {
  width: 1%;
}
*/
#div-petit-profil img {
  width: 80px;
  height: 80px;
}

#div-petit-profil span {
  margin-left: 30px;
  font-weight: bold;
}

#div-petit-profil span#status {
  color: $cPrincipal;
}

/* ************** AFFICHAGE DU GRAND PROFIL ************** */
#div-grand-profil {
  display: table-cell;
  width: 500px;
  text-align: center;
}
#div-grand-profil img {
  width: 150px;
  height: 150px;
}

#div-grand-profil span {
  font-weight: bold;
}

#div-grand-profil span#status {
  color: $cPrincipal;
}


/* ************** CORPS ************** */

#div-corps {
  min-height: 400px;
}


/* ************** PIED ************** */

#div-pied {
  margin-top: 100px;
  margin-bottom: -1px;
  padding: 5px 10px;
  height: 25px;
  
  font-size: 9px;
  text-align: center;
  color: $cPrincipal;
  background-color: $cSecondaire;
  border-radius: 5px 5px 0px 0px;
}

 
/* ************************************************************************************************
 *     CHAMPS DE FORMULAIRES ET BOUTONS
 * ************************************************************************************************ */

 input {
	font-family: Verdana, sans-serif;
}

input[type="text"], input[type="password"] {
	width: 300px;
	padding: 5px 10px;
	border: 1px solid $cSecondaire;
	/*border-radius: 0px 5px 5px 0px;*/
	font-size: 13px;
	color: $cTexte;
}

input[type="button"], input[type="submit"] {
	width: 150px;
	padding: 6px 15px;
	font-family: Verdana, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: $cTexteClair;
	background-color: $cPrincipal;
	border: none;
	border-radius: 5px;
}
input[type="button"]:hover, input[type="submit"]:hover {
	opacity: 0.8;
	cursor: pointer;
}

.btn-secondaire {
	background-color: $cSecondaire !important;
}

.input-file-container {
	display: block;
	position: relative;
	width: 300px;
	padding: 5px 0px 6px 25px;
	font-size: 12px;
	font-weight: bold;
	color: $cPrincipal;
	border: 1px solid $cSecondaire;
	border-radius: 5px 0px 0px 5px;
	background-color: $cSecondaire;
}
input[type="text"].input-file-text {
	position: absolute;
	top: 0px;
	right: 0px;
	max-width: 60%;
	padding-top: 6px;
	padding-bottom: 6px;
	margin-left: 15px;
	font-size: 11px;
	color: $cSecondaire;
	border: none;
	background-color: $cFondClair;
}
.input-file-container input[type="file"] {
	position: absolute;
	top: 0px;
	left: 0px;
	opacity: 0;
}
.input-file-container input[type="file"]:hover {
	cursor: pointer;
}

textarea {
	min-width: 450px;
	padding: 10px;
	font-family: Verdana, sans-serif;
	font-size: 11px;
	border: 1px solid $cSecondaire;
	border-radius: 5px;
}


/* ************************************************************************************************
 *     TITRES, SOUS-TITRES
 * ************************************************************************************************ */
 
h1, h2 {
	color: $cPrincipal;
}
h1 {
	font-size: 18px;
	padding-left: 10px;
	border-bottom: 1px solid $cPrincipal;
	font-weight: normal;
	margin-top: 25px;
	margin-bottom: 15px;
}


/* ************************************************************************************************
 *     TABLES
 * ************************************************************************************************ */

table {
	margin: 0 auto;
}

th {}

.table-horiz th {
	min-width: 120px;
	text-align: left;
	font-weight: bold;
	/*border-bottom: 1px solid $cSecondaire;*/
}

.table-vert {
	border-collapse: collapse;
}
.table-vert th {
	min-width: 50px;
	padding: 5px 20px;
	text-align: left;
	border-bottom: 2px solid $cSecondaire;
}
.table-vert td {
	padding: 5px 20px;
}
.table-vert tr {
	border-bottom: 1px solid $cFond;
}
.table-vert tr:hover {
	background-color: $cFondClair;
}
.table-vert thead tr:hover {
	background: none;
}
.table-vert input[type="image"] {
	width: 25px;
	height: 25px;
	opacity: 0.8;
}
.table-vert input[type="image"]:hover {
	width: 27px;
	height: 27px;
	margin: -1px;
	opacity: 1;
}

.tr-espace {
	display: block;
	height: 10px;
}

.tr-link:hover {
	cursor: pointer;
}

.td-centre {
	text-align: center;
}

.td-droite {
	text-align: right;
}


/* ************************************************************************************************
 *     MESSAGES SUCCES ET ERREUR
 * ************************************************************************************************ */

.messageErreur {
	font-weight : bold;
	color : red;
}

.messageSucces {
	font-weight:bold;
	color : green;
}

/* ************************************************************************************************
 *     TWEETS
 * ************************************************************************************************ */
.tweet {
	position: relative;
	margin: 50px auto;
	padding: 10px 15px;
	width: 750px;
	min-height: 30px;
	border: 1px solid $cFond;
	border-radius: 10px;
	border-color: $cSecondaire;
}
.tweet .votes {
	position: absolute;
	top: 10px;
	right: 15px;
	font-weight: bold;
	color : $cPrincipal;
}	

.tweet-image {
	text-align: center;
	margin-bottom: 5px;
	margin-top: 5px;
}
.tweet-image img {
	max-height: 300px;
}

.tweet-info {
	margin:0px;
}
.tweet-info img {
	width: 40px;
}
.tweet-info .nom {
	margin-left: 20px;
	font-weight: bold;
}
.tweet-info .date {
	margin-left: 20px;
	font-size: 10px;
}

.tweet-message {
	margin-left: 70px;
	margin-bottom: 5px;
	margin-top: 30px;
}

.tweet-button {
	text-align:center;
	margin-top:10px;
}

FINCSS;
?>
