# Idées en vrac:

## Table des matières
- [idées en vrac](#idées-en-vrac)
    - [Ergonomie](#ergonomie)
    - [Partage](#partage)
        - [Partage, ergonomie](#partage-ergonomie)
    - [Discussion](#discussion)
        - [Discussion, ergonomie](#discussion-ergonomie)
    - [Fonctionnalités](#fonctionnalités)
    - [Système](#système)
        - [Mise à jour des données](mise-à-jour-des-données)

## Ergonomie
- [ ] Liste affichés des shaares à la "google+".

## Partage
- [x] Ne pas reprendre le shaare original, 
- [ ] afficher à côté un numéro dans une icône avec le nombre de shaares total,
- [x] si indiqué via *** et que c'est via un shaarli, alors aller chercher dans la bdd le shaare pointé et le mettre en source,
- [x] vérifier l'existance du shaarli source du "via" dans la liste, si il n'existe pas, le rajouter,
- [x] si un shaare "via" est repointé, alors on partage avec la source d'origine même si indiqué "via" un autre.

### Partage, ergonomie
- [ ] Quand on clique sur l'icône du nombre de partages, le post tourne (flip?) et l'on a accès à différents partages par date ASC.

## Discussion
- [ ] Mettre les shaares de réponse en dessous du shaare original,
- [ ] indiquer aussi avec une petite icône (type flame ?) quand c'est une grande discussion.

### Discussion, ergonomie
- [ ] N'afficher que les 3 derniers commentaire avec un nombre max de caractères, avec possibilité d'étendre le post.

## Fonctionnalités
- [ ] Possibilité de créer des "collections": posts regroupés par tag,
- [ ] dans le menu on a une liste des collections que l'on a créé et si on clique dessus, ça affiche les shaares qui ont le ou les tags concernés,
- [ ] possibilité d'une sugestion de collections.

## Système
- [x] ajouter un contrôle de la date de mise à jour du flux avec la date de mise à jour de chaque entrée, ne mettre à jour que si changement, et ou mise à jour en fonction de la date de la dernière entrée mise à jour,
- [x] actuellement le crowl et la bdd différencient http et https pour un même site, à corriger,
- [x] séparer dans une table les liens des shaares,

### Mise à jour des données
- [ ] faire la médiane des shaares pour un shaarer par jour afin de lancer les MAJ en fonction de sa "production",
- [ ] donc, sauvegarder les temps entre les shaares pour un sharer (table stats dédiée colonne un array[time()] = time() - timestamp($published)) sur la journée, garder au minimun 5 valeur (pour garder une bonne médiane même le lendemain matin),
- [x] mettre en place un système de threads afin de faire des mises à jour lancées en même temps en fonction du nombre de threads définis en configuration (fonction ignore_user_abort PHP pour libérer chaque thread lancée par un cron externe),
- [ ] aller chercher les flux 1 à 1 en fonction de la médiane avec uniquement 1 entrée pour vérifier si mise à jour,
- [ ] si mise à jour les placer dans les thread, chaque thread contient les shaarers du plus grand partageur au plus petit, équitablement,
- [ ] retravailler les points précédents. 