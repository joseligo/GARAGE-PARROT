# GARAGE-PARROT
## Résumé du projet:
Dans le cadre de cette ECF, il nous à été demandé de réaliser une application web complète pour le Garage de Mr Vincent Parrot.

Pour son garage ouvert depuis 2 ans, Vincent Parrot souhaite un site web lui permettant une bonne visibilité sur Internet sur lequel il pourra modifier les services proposés par le garage, mettre des annonces pour les véhicules à vendre, mettre à jour les horaires d'ouverture, recueillir les avis clients et recevoir les demandes de rendez-vous. 


## Installation
* Vous devez tout d'abord créer un domaine local dans votre fichier hosts, puis modifier votre vhost d'Apache et redémarrer votre serveur.
* Dans votre dossier, récupérez les sources avec Git ou en les téléchargeant.
* Vous devez ensuite créer une base de données mysql et importer le fichier ecf_garage.sql présent dans le dossier "livrable-study".
* La base de données contient déjà un jeu de données avec également deux utilisateurs (un administrateur et un utilisateur) :
    * user@test.com, mot de passe : test (à ne pas utiliser sur un site en production)
    * admin@test.com, mot de passe : test (à ne pas utiliser sur un site en production)
* Modifiez le fichier App/Db/Mysql en y ajoutant la configuration de votre base de données (lignes 17 à 21 :

        $conf = ['db_name' => '**garage_parrot',

        'db_user' => 'root',
  
        'db_password' => '',
  
        'db_port' => '3306',
  
        'db_host' => 'localhost'];)
* Assurez-vous que le site fonctionne en local.

### Lancement du site 

Vous pouvez désormais lancer le fichier index.php présent dans le repo du projet.

## Site déployé

Vous trouverez le site déployé sur alwaysdata a l'adresse suivante:

https://joseligo.alwaysdata.net/
