# 👨‍🏫 Best practices

> Conventions et guides suivis

### Coding Styles

Suivre **à la lettre** les règles de [php-fig](https://www.php-fig.org/psr/), [PSR-1](https://www.php-fig.org/psr/psr-1/) et [PSR-2](https://www.php-fig.org/psr/psr-2/).  
Sauf qu'on code avec des **tabs**, on est pas des sauvages.

### Assets

#### Général

Les assets front du site doivent être répertoriées dans le dossier `resources/assets`.  
**Ne pas** utiliser le dossier `public` pour développer qui contient les fichiers compilés automatiquement.

Le fichier `webpack.mix.js` se charge de répertorier les fichiers à compiler dans le dossier `public`.

#### Les thèmes

**Ne pas** modifier les fichiers d'un thème utilisé. Par exemple un thème `resources/assets/themes/acme` doit comporter les fichiers d'origines.
* Soit créer un thème enfant `resources/assets/themes/acme_child` et rassembler et recompiler avec webpack les fichiers parent/enfant  
* Soit surcharger par un fichier css par exemple dans `resources/assets/sass/crm/themes/acme/custom.css`

#### Les médias

Le dossier `resources/assets/media` contient les ressources images, vidéos… utilisées côté client. Le dossier complet est accessible depuis public en symlink grâce à la commande [`php artisan assets_media:link`](#-commandes-custom)

### Routes

* Les routes commencent par leur nom, puis la methode avec l'url, puis le where, puis le reste<br>
`Route::name('foo.delete')->get('foo/delete/{id}', [FooController::class], 'delete'])->where(['id' => '\d+'])->middleware('auth');`

### Views

* Les dossiers ou fichiers "abstracts" sont préfixés par un underscore `_`

```
resources
  | views
    | _layouts
      | app.blade.php
      | foo.blade.php
    | _partials
      | hello.blade.php
    | bar
      | list.blade.php
      | ...
```
