README


BULLE EN BAS, TWEETS NON LUS
-------------------------------------------------------------------------------------------
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



