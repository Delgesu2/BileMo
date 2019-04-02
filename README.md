BileMo API
==========

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/79a4a7135dc04561bac89dcf674d7fe2)](https://app.codacy.com/app/Delgesu2/BileMo?utm_source=github.com&utm_medium=referral&utm_content=Delgesu2/BileMo&utm_campaign=Badge_Grade_Dashboard)

Web service exposing an API

*Téléchargez ce projet ou clonez-le (Git clone)*

##Prérequis
+ PHP 7.2
+ MySQL
+ Symfony 4

##Installation
Pour installer le projet, vous devez le cloner ou le télécharger. 
Pour le faire tourner sur votre machine en local, vous pouvez
installer MAMP (ou WAMP pour Windows, ou LAMP pour Linux).

1. Exécuter la commande `composer update` pour mettre à jour les dépendances.
2. Exécuter `php bin/console doctrine:database:create` et 
`php bin/console doctrine:schema:update --force` pour créer la base de données.
3. Exécuter `php bin/console doctrine:fixtures:load` pour charger les *fixtures*.

Rendez vous ensuite sur [http://localhost/api](http://localhost/api) pour
prendre connaissance de l'API.

##Construit avec
* [Symfony](https://symfony.com/): High performance PHP framework for web development
* [API Platform](https://api-platform.com/): REST and GraphQL framework to build modern API-driven projects
* [Alice-Bundle](https://github.com/hautelook/AliceBundle): A Symfony bundle to manage fixtures with nelmio/alice and fzaninotto/Faker.
* [JWT](https://github.com/lcobucci/jwt):A simple library to work with JSON Web Token and JSON Web Signature 
