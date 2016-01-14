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
    Le profil d'un utilisateur contient une image (avatar), un petit message come statut, ainsi
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
s'est basé sur l'accès de l'utilisateur à la page d'accueil. Chaque fois qu'il accède, on
actualise une variable en session qui stocke la dernière date et heure d'accès.

Puis, toutes les N secondes (on a mis 5 pour ne pas devoir attendre beaucoup) on exécute
une fonction javascript qui va chercher, à travers AJAX, la quantité des tweets qui ont été
publiés à partir cette dernière date d'accès jusqu'à maintenant.

Lors de l'affichage de l'accueil, on va aussi identifier les messages qui n'ont pas été lus.
Pour faire ¢a, avant d'actualiser la date dans la session, on réalise une copie dans une
autre variable de session. La view se chargera donc d'afficher différemment les tweets qui
ont été créés entre ces deux dates.

NOTER qu'on compte aussi les tweets créés par l'utilisateur connecté. Ceci n'est pas très
logique, du fait que les messages créés par un utilisateur ne peuvent pas être considérés
comme "non lus" par lui même. Par contre, on l'a implementé de cette manière pour permettre
un test simplifié de la fonctionnalité.



