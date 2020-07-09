# Neymo - Back-end


<strong>Prod : </strong> https://neymo-api.benjaminadida.fr/

NeyMo est un gestionnaire de monnaie locale conçu pour soutenir les associations, les collectivitées et toutes les personnes qui ont à cœur la revalorisation de leurs territoires dans une démarche de développement durable et sociale.
 
Ce site a été réalisé à des fins pédagogiques dans le cadre du cursus Bachelor de l’école HETIC. Les contenus présentés n'ont pas fait l'objet d'une demande de droit d'utilisation. Ce site ne sera en aucun cas exploité à des fins commerciales et ne sera pas publié
 
 ## Installation
 
   ### Générer clefs pour JWT 

 <strong>Créer le dossier </strong> : 
 ```bash
 mkdir -p config/jwt
```
 <strong>Clef privée </strong> :
   ```bash
   openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
  ```
 
 <strong>Clef publique </strong> : 
 ```bash
 openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```
 
 Modifier la variable ```JWT_PASSPHRASE```, avec la passphrase que vous aurez défini
 
  
  ### Le projet est disponible sous Docker 🐳
  
  
   <strong>Cloner le projet</strong> : 
   ```bash
    git clone https://github.com/benads/neymo.git
   ```

  <strong>Exécuter ce script dans le projet</strong> : 
  ```bash
  sh init.sh
 ```
 
 <strong>Pour lancer une commande Symfony dans le container</strong> :
 ```bash
 docker container exec -ti app bash
 ```
 
  <strong><a href="http://localhost">Back-Office/API</a></strong>
 
 <strong><a href="http://localhost/api/doc">Documentation de l'API</a></strong>
 
  <strong><a href='http://localhost:8080'>Client MySQL</a></strong>

 
  ### API Doc
  
  Collection Postman : https://www.getpostman.com/collections/4b49a8cced39c4202581

  Récupérer le token utilisateur sur Postman avec une requête ``login``
 
* <strong>Identifiant de connexion Super-Administrateur</strong>
   ```bash
   {
   	"username": "superadmin@neymo.com",
   	"password": "123456"
   }
  ```
 
* <strong>Identifiant de connexion Administrateur</strong>
   ```bash
   {
   	"username": "admin@neymo.com",
   	"password": "123456"
   }
  ```

* <strong>Identifiant de connexion Commercant</strong>
   ```bash
   {
   	"username": "company@neymo.com",
   	"password": "123456"
   }
  ```
  
* <strong>Identifiant de connexion Particulier</strong>
   ```bash
   {
   	"username": "particular@neymo.com",
   	"password": "123456"
   }
  ``` 

 ### Authentification à l'API via ApiDoc :
 
 <img src="http://fotoforum.fr/photos/2020/07/08.1.gif" >

## Stack technique : 
 ### Général :
 
Tout notre back a été fait en Symfony 5.1.

 Pour ce faire, nous avons utilisé différentes technos pour nos environnements (prod/dev) :
 
 ### Dev :
 
 <strong>Docker :</strong> Nous avons décidé de dockeriser tout notre back pour faciliter l'installation et harmoniser notre environnement entre développeurs.
 Il est composé de 5 images :
 * Le container "app" qui créer un environnement PHP, composer...
 * Le container "db", le server MySQL où est hébergé notre base de données
 * Le container "adminer", le client MySQL qui permet d'avoir une interface graphique de la base de données (Adminer 4.7)
 * Le container "web-server", le server web NGINX qui permet d'avoir un server simple à configurer
 * Le container "mailhog", qui propose deux types de service : un SMTP et une interface pour visualiser les mails

 ### Prod :
 
* <strong>NGINX :</strong> pour avoir un serveur web simple d'utilisation
* <strong>MySQL 5.7 :</strong> pour avoir une base de données qui s'accorde bien avec Symfony grâce à son ORM, Doctrine
* <strong>DigitalOcean :</strong> pour avoir une infrastructure cloud qui fournit une solide documentation
* <strong>Ubuntu 18.0 :</strong> pour avoir un système d'exploitation facile d'accès et modulable

## Composants utilisés

<strong>Doctrine</strong> : ORM
  <br>
<strong>jwt-authentication-bundle</strong> : Authentification API avec JWT
  <br>
<strong>api-doc-bundle</strong> : Gérer la doc de l'API 
  <br>
<strong>cors-bundle</strong> : CORS policy
  <br>
<strong>Mailer</strong> : Envoi d'email
  <br>
<strong>mailjet-apiv3-php</strong> : Permet l'envoi d'email
  <br>
<strong>Faker</strong> : Création des faux jeux de données
  <br>
<strong>php-credit-card-validator</strong> : Vérification la validité des informations d'une carte bancaire
  <br>
<strong>Security</strong> : Gérer le login et les rôles


## Argumentaire détaillé

Notre back-end se divise en 3 parties :

### Interface Super-Adminisitrateur 

La première partie de notre application est un back-office administré uniquement par nous-mêmes, Neymo, agence digitale, pour gérer toutes les gouvernances et leurs administrateurs. 
Nous avons listé les fonctionnalités dont nous avions besoin :
  * Lister toutes les gouvernances
  * Créer, afficher les détails et modifier une gouvernance
  * Créer, lister, modifier et supprimer les administrateurs d'une gouvernance
  
### Interface Administrateur
 
 Cette interface permet aux administrateurs de la gouvernance de pouvoir gérer leur propre gouvernances et leurs adhérents. Ainsi, un administrateur peut :
 * Modifier ses propres informations
 * Lister, créer et supprimer les autres administrateurs de la gouvernance
 * Gérer les différents types d'adhérents (commercant/particulier)
 * Valider ou refuser les demandes d'inscription en attente (envoi d'email de confirmation)
 * [WIP] Voir les détails de la gouvernance
 * [WIP] Accèder à un dashboard pour visualiser les statistiques de la monnaie locale

### API Adhérent
 Cette interface permet de spécifier les différentes fonctionnalités auxquelles ont accès les adhérents.
 <a href="https://neymo-api.benjaminadida.fr/api/doc">Documentation NelmioApiDoc</a>
 
 
## MPD

<img src="https://cdn.discordapp.com/attachments/724913624551784479/730455259545206794/Screenshot_2020-07-08_at_17.54.24.png" >

