# Backend Symfony Opticien

1. Entrer dans le dossier
```
  cd opticien
```

## Installation du projet


1. Cloner le projet
2. Installer les dépendances :
    ```
    composer install
    ```
3. Configurer la base de données dans le fichier `.env` :
    ```
    DATABASE_URL="mysql://root:motdepasse@127.0.0.1:3306/opticien?serverVersion=8.0&charset=utf8mb4"
    ```
4. Créer la base dans MySQL si besoin :
    ```sql
    CREATE DATABASE opticien CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    ```
5. Appliquer les migrations :
    ```
    php bin/console doctrine:migrations:migrate
    ```
6. Créer un utilisateur admin :
    - Avec les fixtures
    - Ou via une commande personnalisée (voir doc projet)

7. Lancer le serveur :
    ```
    symfony server:start
    ```

## Fonctionnalités

- Authentification sécurisée pour les admins (login, logout)
- CRUD complet pour les lunettes et les catégories
- Barre de navigation
- API RESTful sur `/api` pour les catégories et lunettes (compatible frontend)
- Sécurité : seuls les admins accèdent à la gestion

## Routes principales

- `/login` : Connexion
- `/logout` : Déconnexion
- `/lunette` : Gestion des lunettes (admin)
- `/categorie` : Gestion des catégories (admin)
- `/api` : Accès API Platform

## Utilisateur d’exemple

- Email : admin@admin.fr
- Mot de passe : password123
- Rôle : ROLE_ADMIN

## Dépendances principales

- Symfony
- Doctrine ORM
- Symfony Security
- API Platform

---
