#Commandes

Symfony met à disposition des commandes de base, parmis lesquelles :

- crée une base de données suivant la configuration du fichier .env: `php bin/console doctrine:database:create`
- génére un controleur : `php bin/console make:controller`
- génère l'entité (ORM) d'un Bundle : `php bin/console make:entity`
- génère la correspondance ORM(entité)->Schema(Mapping) d'un Bundle : `php bin/console doctrine:generate:entities Bundle:Entity`
- permet de visualiser les mises à jour SQL à prévoire : `php bin/console doctrine:schema:update --dump-sql`
- met à jour la base de données en tenant compte des écarts dans le schema YML : `php bin/console doctrine:schema:update --force``
- réaliser une copie des Assets `php bin/console assetic:dump`
- débloquer la mémoire: `php -d memory_limit=-1 composer.phar`
<<<<<<< HEAD
- insertion des données en base sans vider les structure : `php bin/console doctrine:fixtures:load --append`
=======
- insertion des données de fixtures en base sans vider les tables : `php bin/console doctrine:fixtures:load --append`
>>>>>>> 49e3de886f6d1585a6d562123da76f7f462ffcf5
- Afficher la liste des route : `php bin/console debug:router`