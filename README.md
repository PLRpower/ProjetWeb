# Intern Rift

Intern Rift la faille qui vous mènera à la réussite.

## Prérequis

- Serveur Apache
- PHP 8.0 ou supérieur
- Composer
- Base de donnée MySQL
- Réécriture d'URL activée (```sudo a2enmod rewrite```)
- Extensions :
    - php-xml (pour Twig)
    - php-mysql (pour PDO)
    - php-cli, php-curl, unzip, curl (pour Composer)
    - php-mbstring (pour PHPUnit)

## Installation

### 1. Clonez ce projet :

```bash
git clone https://github.com/PLRPower/ProjetWeb.git
```

### 2. Installez les dépendances PHP via Composer :

```bash
composer install
```

### 3. Créez la base de donnée

Exécutez la commande suivante pour ouvrir MySQL en mode administrateur :

```bash
sudo mysql
```

Ensuite, exécutez le script SQL ci-dessous pour créer l'utilisateur et la base de données pour le projet :

```sql
CREATE
USER 'admin_intern_rift'@'localhost' IDENTIFIED BY 'IJ*23ioo8932JN';
CREATE
DATABASE intern_rift;
GRANT ALL PRIVILEGES ON intern_rift.* TO
'admin_intern_rift'@'localhost';
FLUSH
PRIVILEGES;
```

> Note : si vous modifiez les informations du script SQL, n'oubliez pas de mettre à jour le fichier
> /database/database.php

### 4. Exécutez les migrations pour créer les tables nécessaires :

```bash
composer migrate
```

## Développement

Les fichiers source du projet se trouvent dans le dossier src. Les contrôleurs, modèles et vues sont organisés comme
suit :

- Controllers : Logique de gestion des requêtes et des réponses.
- Models : Interaction avec la base de données.
- Views : Templates de présentation (utilise Twig comme moteur de templates).

## Tests & génération de données

Les tests permettent de vérifier le bon fonctionnement de l'application et de générer des données test dans la base de
données. Vous pouvez exécuter les tests avec PHPUnit :

```bash
composer test
```

## Créé par

Le groupe n°2 de la promo CPI A2 Info 2024-2025 du CESI :

- Martin PHILIP
- Jules PLÜSS
- Kylian LAMBERT
- Paul THOMAS