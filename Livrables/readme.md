Installation du site en local :

- Ouvrir un terminal
- Se placer dans le dossier d'installation souhaité
- Cloner le dépôt git en exécutant la commande suivante en ligne de commande :
  git clone https://github.com/bobo13778/garageVP.git

- A partir du répertoire créé, taper la commande suivante :
  composer install

- Installer et/ou lancez XAMPP, cliquer sur Start pour les services Apache et MySQL
- Cliquer sur Admin correspondant à MySQL

- Dans l'interface phpMyAdmin cliquer sur SQL
- Copier/coller les instructions des fichiers contenus dans le dossier Livrables
  'Création de la base de données.sql'
  'Création des tables.sql'
  'Premier remplissage de la base de données.sql'

Attention à bien insérer les instructions dans cet ordre et à cliquer sur le bouton 'exécuter' de l'interface phpMyAdmin entre chaque fichier!

- A partir de votre dossier cloné, taper la commande suivante dans le terminal :
  symfony server:start -d
- Ouvrir un navigateur (Chrome de préférence) et entrer l'URL indiquée dans le terminal
