# GUIDE D'INSTALLATION ET DE CONFIGURATION DU PROJET LARAVEL

## Introduction
Ce guide décrit toutes les étapes nécessaires pour installer, configurer et exécuter un projet Laravel après l'avoir cloné depuis mon dépôt GitHub.


## Prérequis
Avant de commencer, assurez-vous que les éléments suivants sont installés sur votre machine :
1. PHP (version recommandée : 8.1 ou supérieure)
2. Composer (gestionnaire de dépendances PHP)
3. Node.js et npm (pour gérer les assets front-end)
4. PostgreSQL (pour la base de données)
5. Git (pour cloner le projet)
6. Serveur web (Apache ou Nginx) ou Laravel Sail/Docker pour un environnement conteneurisé.


## Étapes d'installation

### 1. Cloner le dépôt GitHub
Clonez le dépôt sur votre machine locale avec la commande suivante :

    git clone <https://github.com/Ld28Fax/project-Jsan.git>

    cd <project-Jsan>

## Installer les dépendences PHP 

    composer install

## Installer les dépendences front-end

    npm install 

-> si il y a une erreur 

    npm audit fix  

## configuration .env 

    cp .env.example .env

## dans le fichier .env

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=nom_de_la_base (de votre choix)
    DB_USERNAME=postgres
    DB_PASSWORD=mot_de_passe (de votre choix)

## générer le clé d'application 

    php artisan key:generate

## démarrer le serveur de développement 

    php artisan serve 
    npm run dev

## L'application sera accessible à l'adresse :

    http://localhost:8000

