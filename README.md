# API Jeux vidéos

Commande à lancer :
- composer install
- composer require security
- composer require lexik/jwt-authentication-bundle

## Connexion
- Créer un fichier .env à partir du .env.example
- Modifier la variable DATABASE_URL comme vous le souhaitez par rapport à vos besoins
- Modifier MAILER_DSN par rapport à vos besoins

## Création de la base de donnée
- Créer la base de donnée php bin/console doctrine:database:create
- Créer une migration : symfony console make:migration
- Checker le status de nos migrations : symfony console doctrine:migrations:status
- Lancer une migration : symfony console doctrine:migrations:migrate

## Charger les fixtures
- symfony console d:f:l

### Hasher un mdp :
php bin/console security:hash-password

Nelmio pour la création, la gestion et la doc des api:
composer require nelmio/api-doc-bundle

## Commande newsletter
- symfony console send-newsletter

## Lancer le cron pour envoyer un mail tout les lundis à 8h30 (Scheduler):
php bin/console messenger:consume