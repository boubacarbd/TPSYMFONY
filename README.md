# Gestion d'une Bibliothèque avec Symfony

## Description

Ce projet est une application web de gestion d'une bibliothèque, développée avec le framework Symfony. Elle permet aux utilisateurs de s'enregistrer, se connecter, emprunter des livres disponibles, et gérer les emprunts via une interface utilisateur simple et intuitive.

---

## Fonctionnalités

- **Gestion des utilisateurs** :
  - Inscription et connexion.
  - Différenciation entre utilisateurs et administrateurs.

- **Gestion des emprunts** :
  - Affichage de la liste des livres disponibles.
  - Gestion des statuts des emprunts .

- **Gestion des livres** :
  - Ajout, modification, et suppression des livres (réservé aux administrateurs).

- **Gestion des auteurs** :
  - Ajout, modification, et suppression des auteurs (réservé aux administrateurs).


## Prérequis

Avant d'installer le projet, assurez-vous que votre environnement dispose des éléments suivants :

- **PHP** : Version 8.1 ou supérieure.
- **Symfony CLI** : Pour faciliter le développement.
- **Composer** : Gestionnaire de dépendances PHP.
- **Base de données** : MySQL ou toute autre base compatible avec Doctrine.

---

## Installation

1. **Cloner le dépôt :**

   ```bash
   git clone https://github.com/votre-repo/bibliotheque-symfony.git
   cd bibliotheque-symfony
   
Installer les dépendances PHP :

composer install

## Configurer les variables d'environnement :

Copiez le fichier .env et configurez les informations de votre base de données :

cp .env .env.local

## Dans .env.local, modifiez les paramètres suivants :

DATABASE_URL="mysql://username:password@127.0.0.1:3306/bibliotheque"

## Créer la base de données :

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate


## Démarrer le serveur Symfony :

symfony server:start

Accédez à l'application via l'URL suivante :
http://localhost:8000

## Utilisation
## Rôles des utilisateurs

    Administrateur :
        Peut gérer les utilisateurs les auteurs et les livres.
        Dispose de droits d'administration sur tous les emprunts.

    Utilisateur :
        Peut consulter les livres disponibles.
        Peut emprunter des livres.

## Navigation principale

    Accueil : /
        - Inscription : /register
        - Connexion : /login
        - Liste des livres : /borrow (uniquement après la connexion)
        - Administration des emprunts : /admin/borrow

## Technologies utilisées

    Backend : Symfony 6, Doctrine ORM.
    Base de données : MySQL.

## Auteur

    Nom : BOUBACAR  DIALLO
    Email : boubacar2@hotmail.fr

## Petit plus

Problèmes courants et solutions
Erreurs de migration

Si vous rencontrez une erreur liée aux migrations Doctrine, exécutez la commande suivante pour la réparer :

php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate

