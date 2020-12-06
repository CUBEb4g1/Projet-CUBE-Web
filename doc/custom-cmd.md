# 👨‍💻 Commandes custom

> Plusieurs commandes personnalisées :

### `php artisan ide:refresh`

Lié à [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper), permet de rafraichir les fichiers générés par le package.

### `php artisan assets_media:link`

A l'instar de la commande `storage:link` pour les fichier uploadés, va créer un symlink dans le dossier `public` de `resources/assets/medias` pour donner l'accès au client aux assets de type images, vidéos…

### `php artisan project:run`

Executer le fichier `.deploy/deploy.php`

### `php artisan project:disable`

Désactiver l'utilisation du déploiement en mettant à jour le fichier `.deploy/src/config.json`


### `php artisan project:enable`

Activer l'utilisation du déploiement en mettant à jour le fichier `.deploy/src/config.json`
