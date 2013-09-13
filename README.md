[ApocalySpace](http://www.apocalyspace.fr/) - Jeu en ligne
==================================================

ApocalySpace est un jeu en ligne jouable gratuitement et directement sur votre navigateur web mêlant stratégie et gestion dans l'espace. C'est un projet réalisé en 2012 par Benjamin Crosnier, Etienne Rocipon et Julien Bernard.<br />
<br />
Le projet a été repris après l'arrêt de celui-ci par Julien en 2013.<br />
* Ce projet est sous licence GNU GPL.<br />
* Le projet est disponible actuellement en version 1.6 : phase de Bêta fermée<br />


Contribution et Démo
--------------------------------------
Projet sous licence libre [GNU GPL](http://fr.wikipedia.org/wiki/Licence_publique_g%C3%A9n%C3%A9rale_GNU), vous êtes encouragé à participer au projet de différentes manières :<br />
1. [En jouant à ApocalySpace, tout simplement](http://www.apocalyspace.fr)<br />
2. [En démasquant les bugs](https://github.com/JulienBernard/ApocalySpace/issues)<br />
3. [En participant au Wiki](https://github.com/JulienBernard/ApocalySpace/wiki/Accueil)<br />
4. [En forkant le projet](https://github.com/JulienBernard/ApocalySpace)<br />
<br />
[Cliquez ici](http://www.apocalyspace.fr) pour participer à la première Bêta de ApocalySpace.

De quoi avez-vous besoin pour développer votre propre jeu
--------------------------------------

Pour développer en partant du code source d'ApocalySpace, vous avez besoin d'une plateforme de développement Web pour émuler un serveur PHP et une base de données tournant sous MySql (Apache ou Nginx ou autre). L'un des plus connus sous Windows est [WampServer](http://www.wampserver.com/).<br />
<br />
Vous devez bien sûr télécharger le code source du projet soit en téléchargement le ZIP (fourni par GitHub) soit en clonant le projet avec Git.

### Utiliser ApocalySpace

Après avoir téléchargé les sources et installé votre serveur, vous devez créer une nouvelle base de données sur votre serveur MySql qui se nomme `apocalyspace` :	
```sql
CREATE DATABASE apocalyspace;
```

Vous devez ensuite y importer les tables avec le fichier `create.sql` :
```sql
mysql -h (..) -u (..) -p (..) apocalyspace < (..)/create.sql
```

Faites de même avec le fichier `insert.sql` qui va ajouter des données à certaines tables :
```sql
mysql -h (..) -u (..) -p (..) apocalyspace < (..)/insert.sql
```

Ces opérations peuvent très bien être effectuées depuis une GUI comme PhpMyAdmin.

### Configurer ApocalySpace

Modifiez le fichier `config.php` :
```php
	/* Configuration de la base de données */
	define("SQL_DSN", "mysql:host=(..);dbname=apocalyspace");
	define("SQL_USER", " (..) ");
	define("SQL_PASS", " (..) ");
	define("SQL_ENCODE", "utf8");
	
	/* Chemin d'accès du site */
	define("BASE_SITE", "http://localhost/(..)/ApocalySpace/Pilotage/");
	define('BASE_PATH', '/(..)/ApocalySpace/Pilotage/');
```

Lancez dans navigateur préféré (Firefox <3):
```php
http://localhost/(..)/ApocalySpace/Pilotage/
```

### Jouer !

Ou commencer à développer votre propre jeu en modifiant les données contenues principalement dans `/Models/data.class.php`, `config_id.php` et dans la base de données.

Changelog
--------------------------------------

* (1.6) 25/08/13 : Mise en service de la BETA FERME<br />
* (1.5) 03/08/13 : Ajout de la classe Data, début de l'intégration du code<br />
* (1.4) 01/07/13 : Ajout des classes User, Planet et Map<br />
* (1.3) 24/06/13 : Intégration du nouveau moteur du SpaceEngine<br />
* (1.2) 02/06/13 : Ajout des pages Accueil / Histoire / Galerie / Support / Mentions / Histoire du projet<br />
* (1.1) 02/06/13 : Intégration du SpaceEngine sur ApocalySpace. Intégration de Foundation4 sur le moteur<br />
* (1.0) 01/06/13 : Développement du SpaceEngine, le moteur du site internet<br />

Questions ?
--------------------------------------

Vous pouvez me contacter directement sur GitHub via les `issues` si vous démasquez un bug ou bien me joindre sur le jeu via mon pseudonyme `Jibi`.
