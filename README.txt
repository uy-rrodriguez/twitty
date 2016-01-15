      Twitty, réseau social pour publier des textes avec images, voter et partager.
*******************************************************************************************

Conception Internet et Bases de Données
Université d'Avignon et des Pays de Vaucluse
Année scolaire 2015-2016

Binôme:
  GARAYT, Thomas
  RODRIGUEZ, Ricardo

Groupe:
  TD 5

URL:
  https://pedago02a.univ-avignon.fr/~uapv1601663/twitty/twitty.php


-------------------------------------------------------------------------------------------
      Fonctionnalités implementées utilisant AJAX
-------------------------------------------------------------------------------------------

> Création d'un nouveau tweet, avec ou sans image
    Après sa création, le tweet est affiché en haut de la liste de tweets de l'utilisateur

> Voter un tweet.
    Noter qu'un tweet peut être voté une seule fois par le même utilisateur. Après de voter,
    un compteur est incrementé en haut à droite, dans le div du tweet.

> Partager un tweet
    Après le partage, et seulement dans les pages Accueil et Mes tweets, le nouveau tweet
    est affiché en haut de la liste de tweets. On peut aussi partager un des tweets affichés
    dans le profil d'un autre utilisateur, mais après le partage on ne l'affiche pas sur cette
    liste là, ce qui est logique puisque la liste contient les tweets d'un autre utilisateur.

> Requête pour chercher le nombre de tweets sans lire
    Le logo de la page web est affiché en bas à droite de chaque page. Toutes les n secondes,
    une requête AJAX cherche les derniers tweets publiés qui n'ont pas été lus. Les détails
    sur cette fonctionnalité sont décrits dans la prochaine section de ce document.

> Modification de profil et du mot de passe
    Le profil d'un utilisateur contient une image (avatar), un petit message comme statut, ainsi
    que son nom et prénom. Ces données et le mot de passe pour se connecter peuvent être modifiés
    accédant à la partie Paramètres du menu. La modification se réalise en envoyant une requête
    AJAX. Dans le cas de la modification du profil, les changements sont affichés tout de suite
    à gauche du menu.



-------------------------------------------------------------------------------------------
      Autres fonctionnalités implementées
-------------------------------------------------------------------------------------------

 Bulle en bas, tweets non lus
------------------------------
Pour implémenter la petite bulle en bas, qui affiche le nombre de messages sans lire, on
s'est basé sur l'accès de l'utilisateur à la page d'accueil. Chaque fois qu'il y accède, on
actualise une variable en session qui stocke la dernière date et heure d'accès.

Puis, toutes les N secondes (on a mis 5 pour ne pas devoir attendre beaucoup) on exécute
une fonction javascript qui va chercher, à travers AJAX, la quantité des tweets qui ont été
publiés à partir cette dernière date d'accès jusqu'à maintenant.

Lors de l'affichage de l'accueil, on va aussi identifier les messages qui n'ont pas été lus.
Pour faire ca, avant d'actualiser la date dans la session, on réalise une copie dans une
autre variable de session. La view se chargera donc d'afficher différemment les tweets qui
ont été créés entre ces deux dates.

NOTER qu'on compte aussi les tweets créés par l'utilisateur connecté. Ceci n'est pas très
logique, du fait que les messages créés par un utilisateur ne peuvent pas être considérés
comme "non lus" par lui même. Par contre, on l'a implementé de cette manière pour permettre
un test simplifié de la fonctionnalité.



-------------------------------------------------------------------------------------------
      Commentaires sur l'implémentation
-------------------------------------------------------------------------------------------

 Liste de tweets limitée
-------------------------
Pour éviter une attente de chargement trop longue dans la page d'accueil, la liste des
tweets affichée est limitée aux 100 derniers tweets.

 URL des images stockés dans la base de données
------------------------------------------------
Afin de voir correctement les images des autres utilisateurs, nous nous sommes mis d'accord
avec d'autres camarades pour stocker l'url complète de l'image, même si cela ne se ferait
pas pour un système réel.


 Contrôles d'accès aux pages
-----------------------------
Dans twitty.php il y a une méthode pour contrôler l'accès aux pages.
S'il existe un utilisateur connecté (enregistré dans la session), et l'action à exécuter
correspond à la page de login ou aux actions pour enregistrer un utilisateur, on rédirige
le flux vers la page d'accueil.
Dans le cas opposé, s'il n'y a pas un utilisateur connecté et on essaie d'exécuter une action
différente du login ou des actions permettant l'inscription, on rédirige le flux vers le login.


 Attribut parent d'un tweet
----------------------------
En regardant la structure de la base de données, l'attribut parent n'est pas obligatoire lors
de la création d'un tweet. Nous avons interprété cette caractéristique de la manière suivante :
    - La première fois qu'un tweet est publié, le parent est le même que l'emetteur. Il n'est donc
      pas nécessaire de répéter cette information en la stockant dans la base.
    - Quand un tweet est partagé, il est nécéssaire indiquer qui est le parent, l'emetteur initial
      du message.

En discutant avec nos collègues, nous avons réalisé que beaucoup d'entre eux stockent le parent
lors de la création du tweet. Nous estimons, par contre, que faire ainsi ajoute une donnée dans
la base qui n'est pas nécéssaire. En plus, notre choix d'implémentation nous permet d'identifier
facilement quand un tweet a été partagé, ou si c'est le premièr publié. Ce dernier point affecte
notamment l'affichage du tweet.
