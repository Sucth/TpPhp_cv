# Formulaire de CV

Ce projet est un formulaire de création de CV et un système de gestion des CV en PHP avec une base de données SQLite. Les utilisateurs peuvent saisir leurs informations professionnelles et personnelles pour générer un CV et le stocker dans la base de données.

## Fonctionnalités

- **Formulaire de création de CV :** Les utilisateurs peuvent saisir des informations telles que nom, prénom, expérience professionnelle, éducation, etc., pour générer leur CV.
- **Enregistrement des CV :** Les CV créés sont enregistrés dans une base de données SQLite.
- **Gestion des CV :** Les utilisateurs peuvent visualiser tous les CV enregistrés, les modifier et les supprimer.

## Structure du Projet

- **index.php :** Le formulaire de création de CV et le code pour enregistrer les informations dans la base de données.
- **listCv.php :** Affichage de tous les CV enregistrés.
- **allTemplate.php :** Affichage de différents templates pour les CV.
- **update_cv.php :** Permet la mise à jour des informations d'un CV spécifique.
- **delete_cv.php :** Gère la suppression d'un CV.
- **CVDatabase.php :** Contient la classe pour interagir avec la base de données.
- **temp(NBR)_PDF.php :** Template pour les cv.

## Configuration

Pour utiliser ce projet, assurez-vous d'avoir :
- PHP installé sur votre serveur.
- Les autorisations nécessaires pour l'écriture des fichiers (pour l'enregistrement des CV et des images).
- Une base de données SQLite nommée `cv_database.db`.

## Comment Utiliser

1. Cloner ce dépôt dans votre environnement PHP.
2. Assurez-vous que la base de données `cv_database.db` est créée et accessible en écriture.
3. Accédez au formulaire de création de CV en ouvrant `index.php` dans votre navigateur.
4. Remplissez le formulaire et enregistrez votre CV.
5. Utilisez les fonctionnalités de gestion pour voir, mettre à jour ou supprimer des CV.
