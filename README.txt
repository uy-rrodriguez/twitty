      Twitty, réseau social pour publier des notes avec images, voter et partager.
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
    Noter qu'un tweet peut être voté une seule fois par le même utilisateur.

> Partager un tweet
    Après le partage, et seulement dans les pages Accueil et Mes tweets, le nouveau tweet
    est affiché en haut de la liste de tweets. On peut aussi partager un des tweets affichés
    dans le profil d'un autre utilisateur, mais après le partage on ne l'affiche pas.

> Requête pour chercher le nombre de tweets sans lire

> Modification de profil et du mot de passe



-------------------------------------------------------------------------------------------
      Autres fonctionnalités implementées
-------------------------------------------------------------------------------------------


 Bulle en bas, tweets non lus
------------------------------
Pour implémenter la petite bulle en bas, qui affiche les messages sans voir
on s'est basé sur l'accès de l'utilisateur à la page d'accueil.
Chaque fois qu'il accède, on actualise une variable en session qui stocke
la dernière date et heure d'accès.

Puis, toutes les N secondes (on a mis 5 pour ne pas devoir attendre beaucoup)
on exécute une fonction javascript qui va chercher, à travers AJAX, la quantité
des tweets qui ont été publiés depuis cette dernière date d'accès jusqu'à maintenant.

Lors de l'affichage de l'accueil, on va aussi identifier les messages qui n'ont
pas été lus. Pour faire ¢a, avant d'actualiser la date dans la session, on va
la copier dans une autre variable de session. La view devra donc afficher
différemment les tweets aui ont été créés entre ces deux dates.



