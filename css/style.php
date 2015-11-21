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
 *         QUELQUES STYLES GÉNERALES ET POUR LA STRUCTURE
 * ************************************************************************************************ */

body {
    /*background-color: $cFondClair;*/
    font-family: Verdana, sans-serif;
    font-size: 13px;
    color: $cTexte;
    margin: 0px;
}

div, span, table, tr, th, td, input, label {
    box-sizing: border-box;
}

#div-centre {
    position: relative;
    margin: 0px auto;
    width: 900px;
    min-height: 400px;
    padding: 30px 40px 0px 40px;
    border: 1px solid $cSecondaire;
    border-radius: 10px;
    
    /* Effet de menu statique */
    /*margin-top: 110px;*/
    border-top: none;
    border-radius: 0px 0px 10px 10px;
}


/* ******************************************  TETE  ********************************************** */

#div-tete {
    width: /*900px*/ 100%;
    
    /* Effet de menu statique */
    position: relative;
    z-index: 1000000;
    top: 0px;
    left: 0px;
    padding: 10px 0px;
    background-color: $cSecondaire;
}

#div-tete-contenu {
    display: table;
    position: relative;
    top: 0px;
    left: 50%;
    width: 900px;
    margin-left: -450px;
    padding: 0px 20px 0px 20px;
}


/* *****************************************  SCROLL  ********************************************* */

#div-centre.on-scroll {
    margin-top: 105px;
}

#div-tete.on-scroll {
    position: fixed;
    padding-top: 0px;
}

#div-tete.on-scroll #div-petit-profil img {
    width: 40px;
    height: 40px;
    border-radius: 20px;
}

#div-tete.on-scroll #div-petit-profil-donnees {
    margin-left: 10px;
}

#div-tete.on-scroll #div-petit-profil-donnees span.nom {
    font-size: 13px;
}


/* ******************************************  MENU  ********************************************** */

#div-menu {
    display: table-cell;
}

#menu {
    float: right;
    margin: 0px;
    padding: 0px;
}

#menu li {
    display: inline-block;
    margin-left: -2px;
    margin-right: -2px;
    padding: 2px 20px;
    vertical-align: bottom;
    list-style-type: none;
    border-right: 2px solid $cPrincipal;
    /*border-radius: 5px 5px 5px 5px;*/
    /*background-color: $cFond;*/
}

#menu li:hover, #menu li.item-image:hover {
    background-color: $cPrincipal;
    cursor: pointer;
}

#menu li a {
    color: $cTexte;
    text-decoration: none;
}

#menu li#item-active {
    border: none;
    background-color: $cPrincipal;
}

#menu li#item-active a {
    color: $cTexteClair;
}

#menu li.item-image {
    padding: 0px 10px 0px 10px;
    background: none;
    border-right: none;
}

#menu li.item-image img {
    width: 18px;
    height: 18px;
    opacity: 0.5;
    margin-bottom: -1px;
}


/* **************************************  PETIT PROFIL  ****************************************** */

#div-petit-profil {
    display: table-cell;
    padding-left: 10px;
}

#div-petit-profil div {
    display: inline-block;
}

#div-petit-profil img {
    width: 80px;
    height: 80px;
    border-radius: 40px;
}

#div-petit-profil-donnees {
    position: relative;
}

#div-petit-profil-donnees {
    margin-left: 30px;
    font-weight: bold;
}

#div-petit-profil-donnees span.nom {
    font-size: 16px;
}

#div-petit-profil-donnees span.statut {
    color: $cPrincipal;
}


/* ****************************************  GRAND PROFIL  **************************************** */

#div-grand-profil {
}

#div-grand-profil img {
    width: 120px;
    height: 120px;
    border-radius: 40px;
}

#div-grand-profil span {
    margin-left: 30px;
    font-weight: bold;
}

#div-grand-profil span.nom {
    font-size: 14px;
}

#div-grand-profil span.statut {
    color: $cPrincipal;
}


/* ******************************************  CORPS  ********************************************* */

#div-corps {
    min-height: 400px;
}


/* *******************************************  PIED  ********************************************* */

#div-pied {
    margin-top: 50px;
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
 *         CHAMPS DE FORMULAIRES ET BOUTONS
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
 *         TITRES, SOUS-TITRES
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
 *         TABLES
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
 *         MESSAGES SUCCES ET ERREUR
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
 *         TWEETS
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
