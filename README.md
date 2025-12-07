# README : Système de Réservations d'Activités Anisse El Bezazi et Quentin Deglas

Ce projet est une application web de gestion et de réservation d'activités, développée en PHP selon l'architecture MVC (Modèle-Vue-Contrôleur).

## Configuration du Projet (Setup Local)

### 1. Prérequis

- Environnement de serveur local (Laragon, XAMPP, MAMP).
- PHP 8.x.
- MySQL/MariaDB.
- Composer (Gestionnaire de dépendances PHP).

### 2. Installation des Dépendances

Exécuter la commande `composer install` a la racine du projet

### 3. Base de Données (BDD)

1. Crée une nouvelle base de données qui doit être nommée `user`.
2. Importe le code SQL (fichier BaseDeDonnées.sql) pour créer les tables.

### 4. Fichier de Configuration de la BDD

Les informations de connexion suivantes doivent être utilisées dans ton fichier de configuration (par exemple .env ou config/Bdd.php) :

| Variable | Valeur par Défaut | Description                                 |
| :------- | :---------------- | :------------------------------------------ |
| host     | localhost         | L'adresse de ton serveur de BDD.            |
| dbname   | user              | Le nom de la base de données (obligatoire). |
| username | root              | compte MySQL.                               |
| port     | 3306              | Port standard de MySQL.                     |
| password | ''                | mot de passe MySQL (souvent vide).          |

### 5. Lancement

php -S localhost:3000

## Accès et Rôles

Il y a deux rôles : user et admin (faut le rentrer a la main dans la bdd)

### Compte Administrateur par Défaut

| admin | anisse.elbezazi@gmail.com | salam |

### Fonctionnement du Mode Admin

Administration des Activités : L'Admin voit les boutons Supprimer, Modifier et Ajouter apparaître.
Réservations : Le rôle admin ne peut pas faire de réservation.

---

## Routes Principales de l'Application

| URL | Description | Rôle Requis |

| / | Accueil : Liste des activités. | Tous |
| /activities/details/{id} | Détails d'une activité. | Tous |
| /reservation | Liste des réservations de l'utilisateur connecté. | User/Admin |
| /reservation/cancel/{id} | Annuler une réservation (ID de la Réservation). | User |
| /user/findAll | Voir la liste de tous les utilisateurs. | User et admin |

### Routes admin

| URL                     | Action                                                    | Rôle Requis |
| :---------------------- | :-------------------------------------------------------- | :---------- |
| /activities/add         | Ajout d'activité.                                         | Admin       |
| /activities/update/{id} | Modification d'activité.                                  | Admin       |
| /activities/delete/{id} | Suppression d'activité (supprime les réservations liées). | Admin       |

---
