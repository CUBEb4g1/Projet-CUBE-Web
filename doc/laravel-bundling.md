# 📦 Laravel Bundling

> Séparer le code en plusieurs modules  
> Les exemples utilisent un module d'exemple nommé "Acme"

## 📥 Installer un module

> Installer un module déjà existant

### Installer un nouveau module

* Glisser le dossier dans `modules`
* `php artisan module:install acme`
* `php artisan module:link acme`
* Ajouter à la main dans webpack.mix.js la ligne `require(__dirname + '/modules/Acme/webpack.mix.js');`

* Si existante suivre la doc du module pour d'autres étapes d'installation 

### Activer / Désactiver un module

* `php artisan module:enable acme`
* `php artisan module:disable acme`

## 🧰 Créer un module

> Créer une nouveau module qui pourra être installé désinstallé

### 📚 Génération des fichiers

Commencer par générer tous les fichiers du nouveau module avec la ligne de commande suivante :

* `php artisan make:module acme`

Le module généré sera disponible dans le dossier `modules` à la racine du projet. S'il n'existe pas il sera automatiquement créé.

### 🛣️ Les routes

Les controlleurs des routes sont tous disponibles sous le namespace `Modules\Acme\App\Http\Controllers`.

### 📄 Les vues

Les vues sont toutes disponibles depuis le namespace du module. Par exemple pour accéder à une vue du module Acme : `acme::front.homepage`

### ⚙️ Les settings

Il est possible d'ajouter des settings en utilisant la [Facade "Settings"](helpers-services.md#settings---apprepositoriesfacadessettings), une Facade disponible dans la base de Laravel.

#### Créer une migration

Pour commencer à ajouter des paramètres en base de donnée, utiliser une migration.  
> Une bonne pratique est de ne pas utiliser de model pour rester le plus "framework agnostic" possible. Cela évite des erreurs si jamais la logique PHP évolue avec le temps (modification du model etc…).

```php
// Exemple d'une migration

use App\Repositories\Facades\Settings;

DB::table('settings')->insert([
	'name'   => 'acme_foo',
	'value'  => '1',
	'type'   => 'boolean',
	'module' => 'acme',
]);

// Très important, vider le cache une fois la base de donnée modifiée
Settings::clearCache();
``` 

#### Ajouter les settings dans le BO

Il est possible de lister des settings automatiquement dans la page du backoffice dédiée.  
Créer un fichier blade à l'exacte structre suivante : `modules/Acme/resources/views/back/settings/parameters.blade.php`  
Le fichier sera alors inclus dans la page du backoffice.

```html
<!-- Exemple d'une page incluse -->
<h1>Mon module</h4>

<input type="checkbox" id="acme_foo" name="acme_foo" {{ old('acme_foo') ?? $settings['acme_foo']->value ? 'checked' :'' }}>
<label for="acme_foo">This is my setting</label>
```
