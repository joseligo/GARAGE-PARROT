# GARAGE-PARROT
## Résumé du projet:
Dans le cadre de cette ECF, il nous à été demandé de réaliser une application web complète. Cette application est un Site web pour le Garage de Mr Vincent Parrot . Après 15 ans d’expérience, il vient ouvrir son garage et me demande donc de lui ouvrir les portes du Web. L’application que je vais donc lui proposer, mettra donc en avant sont savoir faire et tout particulièrement les services proposés par ce dernier. Le client veut avoir accès sur la modification de ces services par le biais d’un panel administrateur qu’il sera le seul à avoir accès. De plus, en cas de changement horaire le client veut aussi la possibilité de les mettre à jour. Mr Parrot veut aussi que c’est client puissent donnée leur avis sur son travail ainsi que le contacté à tout moment via un formulaire de contact, ainsi que c’est donné de contact présente sur tous les pages du site. 

Pour faciliter la vente de véhicule, part importante du garage, j’ai aussi intégré une page permettant de visualiser et contacté de façon rapide le garage pour chaque annonce. Pour faciliter la navigation, à la demande du client j’ai intégré un filtre sur les kilomètres, l’année de mise en circulation et pour finir sur le prix. Le client m’a demandé que ce panel soit géré par c’est employé, pour ceux faire, la création d’employé sera exclusivement soumise à Mr Parrot via son compte administrateur. 




## Installation en local:
1- Téléchargement et installation de mon Repo.

- Pour commencé il sera nécéssaire de clone mon projet.

```bash
git clone https://github.com/marsaudolivier/ECF_MarsaudOlivier
```

2- Mise en place de la  BDD.
- Pour commencé récupéré l'ensemble des donnés sur le Repo SQL .
https://github.com/marsaudolivier/ECF_SQL_MarsaudO

Dans ce projet, je vais d'un coté BDD utilisé "alwaysdata" qui permet de bénéficier gratuitement d'un BDD de 100Mo maximum. 

Coté front, Nous utiliserons HTML, CSS, SASS, Bootstrap 

Coté Back, le Choix ce portera sur PHP sans framework.

En ce qui concerne hébergement : nous utiliserons alwaysdata solution gratuite pour un projet PHP.


- Pour la création en local, lancé votre serveur Apache via Wamp, Xamp ou autres.
Une fois lancé créée la base de données Exemple : marsaudolivier_garageparrot.

Puis utilisé le fichier Parrot.SQL, et installé dans votre base de données l’ensemble des tables présentes.

Ensuite nous allons créer l’utilisateurs VParrot : Exécuté le fichier CréationCompteMrParrot.php avec votre serveur APache une foi les données $user, $pass, $host, $port configuré (suivre les commentaires du code.)

Il Sera ensuite possible d’importer les données fictive présente dans le fichier : donnée_fictive_Parrot.sql .

### Lancement du site 

Vous pouvez désormais lancer le fichier index.php présent dans le repo du projet.
## Site déployé

Vous trouverez le site déployé sur alwaysdata a l'adresse suivante:

https://marsaudolivier.alwaysdata.net/