# Pizzatroce
It's Crazy Charly Day


Installation sur une machine quelconque :

 - Il faut avoir un serveur web (type apache) et MySql sur la machine pour que tout fonctionne correctement.

 - Executer le script base_mywishlist.sql pour avoir une base de donnée utilisable.

 - Executer la commande "composer install" dans le dossier src pour importer les librairies nécessaires.
 
 - Dans src, il faut créer un répertoire "conf" dans lequel il faut créer un fichier "conf.ini".
   Ce fichier se présente sous la forme suivante et sera à compléter pour établir la connexion à la base de donnée :
   
       driver=
       username=
       password=
       host=
       database=
       charset=utf8
       collation=utf8_unicode_ci
