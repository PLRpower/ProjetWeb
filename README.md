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

## Installation

1. Clonez ce projet :

```bash
git clone https://github.com/PLRPower/ProjetWeb.git
```

2. Installez les dépendances PHP via Composer :

```bash
composer install
```

3. Configurez la base de données dans database/database.php en ajoutant vos informations de connexion.

4. Exécutez les migrations pour créer les tables nécessaires :

```bashcom
composer migrate
```

## Développement

Les fichiers source du projet se trouvent dans le dossier src. Les contrôleurs, modèles et vues sont organisés comme
suit :

- Controllers : Logique de gestion des requêtes et des réponses.
- Models : Interaction avec la base de données.
- Views : Templates de présentation (utilise Twig comme moteur de templates).

## Tests

Les tests sont situés dans le dossier tests. Vous pouvez exécuter les tests avec PHPUnit :

```bash
composer test
```

## Créé par

Le groupe n°2 de la promo CPI A2 Info 2024-2025 du CESI :

- Martin PHILIP
- Jules PLÜSS
- Kylian LAMBERT
- Paul THOMAS