# Compte rendu projet Top ventes

## Initialisation du projet

Modifier le fichier '.env' pour que la ligne commençant par 'DATABASE_URL' corresponde à votre BDD.

``$ composer install``

``$ php bin/console doctrine:database:create``

``$ php bin/console doctrine:migrations:migrate``

## Exécution du projet

Si vous souhaitez modifier le jeu de test par défaut, modifiez le fichier './src/DataFixtures/AppFixtures.php'

Ce jeu de test génère des catégories, produits et commandes aléatoirement, il se peut donc qu'il existe aucun produit dans certaines catégories ou aucun produit dans les commandes.

``$ php bin/console doctrine:fixtures:load``

``$ php bin/console export-csv``

Le fichier ".csv" est alors généré dans "./public/export_janine.csv".

Ce fichier à pour séparateur le ";" il faut le préciser lorsque vous charger le fichier dans votre éditeur de fichier.

Ce fichier contient les Top 3 des meilleures ventes de chaque catégories triées par ordre alphabétique de la catégorie puis par montant DESC.

Il se peut que certaines catégories ne possèdent qu'un Top 1 ou un Top 2 car il n'y a qu'un ou deux produits qui ont été généré aléatoirement.