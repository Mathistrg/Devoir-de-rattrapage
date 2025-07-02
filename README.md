# Backend Symfony Opticien

## Installation du projet

1. **Cloner le projet**

2. **Entter dans le dossier**
   ```bash
   cd opticien
   ```
3. **Installer les dépendances** :

   ```bash
   composer install
   ```

4. **Configurer la base de données dans le fichier `.env`** :

   ```
   DATABASE_URL="mysql://root:password_dev_opticien@127.0.0.1:3306/opticien?serverVersion=8.0&charset=utf8mb4"
   ```

5. **Créer la base de données** (ne pas le faire à la main, utilisez la commande Symfony) :

   ```bash
   php bin/console doctrine:database:create
   ```

6. **Appliquer les migrations** :

   ```bash
   php bin/console doctrine:migrations:migrate
   ```

7. **Générer un utilisateur admin de test avec les fixtures** :

   ```bash
   php bin/console doctrine:fixtures:load
   ```

8. **Lancer le serveur Symfony** :

   ```bash
   symfony server:start
   ```

---

## Fonctionnalités

* Authentification sécurisée (login, logout)
* Page d’accueil = connexion (ou inscription si aucun utilisateur)
* CRUD complet pour les lunettes et les catégories (admin)
* Barre de navigation
* API RESTful sur `/api` (catégories et lunettes)
* Sécurité : seuls les utilisateurs connectés voient et gèrent les lunettes/catégories.
* Seul l’admin peut ajouter/modifier/supprimer

---

## Flow d’accès

* **La page d’accueil affiche le formulaire de connexion si au moins un compte existe.**
* **Si aucun compte, l’utilisateur est automatiquement redirigé vers la page d’inscription.**
* **Après connexion, l’accès à toutes les fonctionnalités nécessite d’être authentifié.**
* **La gestion (ajout, édition, suppression) n’est accessible qu’aux admins.**
* **L’API REST nécessite d’être connecté.**

---

## Commandes utiles

* **Créer la base de données :**
  `php bin/console doctrine:database:create`
* **Lancer les migrations :**
  `php bin/console doctrine:migrations:migrate`
* **Charger les fixtures (admin de test) :**
  `php bin/console doctrine:fixtures:load`
* **Démarrer le serveur Symfony :**
  `symfony server:start`

---

## Routes principales

* `/login` : Connexion
* `/logout` : Déconnexion
* `/register` : Création d’un compte (uniquement si aucun utilisateur)
* `/lunettes` : Gestion des lunettes (admin/user)
* `/categories` : Gestion des catégories (admin/user)
* `/api` : Accès API Platform (authentification requise)

---

## Exemple d’utilisateur

* **Email** : [admin@admin.fr](mailto:admin@admin.fr)
* **Mot de passe** : password123
* **Rôle** : ROLE\_ADMIN

---

## Dépendances principales

* Symfony (Framework)
* Doctrine ORM
* Symfony Security
* API Platform
