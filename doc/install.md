# 👷 Installation

> Installer le site en local pour développement ou sur un serveur pour la production

## Développement

**.env**
  - [ ] `APP_NAME=`
  - [ ] `APP_ENV=local`
  - [ ] `APP_DEBUG=true`
  - [ ] `DB_…`
  - [ ] `MAIL_…`
  
**Commandes**
  - [ ] `composer update`
  - [ ] `php artisan migrate:fresh --seed`
  - [ ] `php artisan key:generate`
  - [ ] `php artisan deploy:run --dev`

**Si besoin des websockets**
- **`.env`**
  - [ ] `BROADCAST_DRIVER=redis`
  - [ ] `REDIS_QUEUE=nom_du_user_du_projet`
  - [ ] `LARAVEL_ECHO_PORT=600x`
- **`config/app.php`**
  - [ ] Décommenter `App\Providers\BroadcastServiceProvider::class,`
- **`resources/assets/js/common.js`**
  - [ ] Décommenter et utiliser la partie concernant [Laravel Echo](https://laravel.com/docs/5.8/broadcasting#installing-laravel-echo) 
- **`cmd`**
  - [ ] `laravel-echo-server init`

## Production

**.env**
  - [ ] `APP_NAME=`
  - [ ] `APP_ENV=production`
  - [ ] `APP_DEBUG=false`
  - [ ] `CACHE_DRIVER=redis`
  - [ ] `DB_…`
  - [ ] `MAIL_…`
  
  **Commandes**
  - [ ] `composer install`
  - [ ] `php artisan migrate:fresh --seed`
  - [ ] `php artisan key:generate`
  - [ ] `php artisan deploy:run`

**Si besoin des websockets**
- **`.env`**
  - [ ] `BROADCAST_DRIVER=redis`
  - [ ] `REDIS_QUEUE=nom_du_user_du_projet`
  - [ ] `LARAVEL_ECHO_PORT=600x`
- **Commandes**
  - [ ] Lancer [Laravel Echo](https://laravel.com/docs/5.8/broadcasting#installing-laravel-echo) sur le serveur `laravel-echo-server init`

## Checklist des configs tiers

- **Vérifier les infos des configs**
  - [ ] `mail_app.default`
  - [ ] `mail.from.address|name`
