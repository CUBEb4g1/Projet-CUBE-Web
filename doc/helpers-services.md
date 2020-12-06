# 🔨 Services

## SwitchSession - `App\Services\Auth\SwitchSession`
 
> Se connecter au compte d'un utilisateur en utilisant son id en bdd.

L'id de l'utilisateur effectuant l'action est enregistré en session, et est utilisé pour se reconnecter à son vrai compte.  
Voir la classe pour plus de détails sur le fonctionnement.  

- Le controlleur `App\Auth\AuthAsUserController` utilise ce service.  
- En utilisant la route `auth.switch` en POST, passer en paramètre `id`, l'id du User auquel se connecter.  
- En utilisant la route `auth.switch.retrieve` en POST, l'utilisateur retrouve son vrai compte.
- Il existe une directive Blade `@ifSwitchedAuth()`

## Settings - `App\Repositories\Facades\Settings`

> Enregistrer des paramètres en bdd et les utiliser dans le projet

### Model et Repository

Les paramètres sont enregistrés dans la table `settings` via le model `App\Models\Setting`.  
Le repository `App\Repositories\SettingRepository` donne accès à plusieurs fonctions pour récupérer et gérer ces paramètres.

#### Récupérer les paramètres en cache

```php
/**
 * Retourne tous les Settings et les placer en cache 24h
 *
 * @return Setting[]
 */
public function allCached()
```

#### Vider la mise en cache

```php
/**
 * Effacer les résultats en cache
 */
public function clearCache()
```

### Utiliser la façade

Cette classe `SettingRepository` est répertoriée dans le service container de Laravel sous la façade `Settings`.  
Un helper `settings()` existe également (voir [les helpers](#settings)).

### Attacher un fichier

Une fois le model enregistré en base de donnée, utiliser la fonction `attachFile()` pour attacher un fichier. Au besoin des thumbnails sont automatiquement générées.

## Breadcrumb - `App\Services\Breadcrumb\Facades\Breadcrumb`

> Générer automatiquement un breadcrumb selon un fichier de config

### Configuration

Dans le fichier `config/breadcrumb.php` répertorier la relation des pages entre elles. Par exemple :

```php
<?php

// config/breadcrumb.php

return [
	['text' => 'Accueil', 'route' => 'home'],

	['text' => 'Contact', 'route' => 'contact'],

	[
		'text' => 'Mes Finances', 'route' => 'finances.dashboard',
		'sub' => [
			['text' => 'Mon Portfeuille', 'route' => 'finances.portefeuille'],
			['text' => 'Ma Banque', 'route' => 'finances.banque'],
			['text' => 'Paramètres', 'route' => 'finances.parameters'],
		]
	],
];
```

### Récupérer le breadcrumb actuel

Utiliser la facade pour récupérer dans un tableau les liens menant jusqu'à la page actuelle `Breadcrumb::current()`

```php
/**
 * Retourne le breadcrumb menant à la page actuelle
 *
 * @return array
 */
public function current(): array
```

### Récupérer le breadcrumb menant à une route

`Breadcrumb::get()`

```php
/**
 * Retourne le breadcrumb menant à la page d'une route donnée
 *
 * @param string $route
 *
 * @return array
 */
public function get(string $route): array
```

# ⛏️ Traits pour les Models

## HasAttachedFiles - `App\Models\Traits\HasAttachedFiles`

> Attacher un fichier uploadé à un model

### Installation

Définir la fonction `attachedFiles` dans le model pour y référencer les fichiers à attacher au model.  
Cette fonction doit retourner un tableau référençant tous les attributs du model qui doivent être liés à un fichier.

```php
// Exemple de configuration à placer dans le model
public function attachedFiles()
{
    return [
        // Nom de l'attribut du model en clef
        'cover' => [
            // Nom du fichier uploadé
            // Ici on utilise uniqid() pour éviter que le nom du fichier ne soit prévisible et
            // facilement récupérable en bouclant sur le dossier
            'name'       => 'avatar-'.$this->id.'-'.uniqid(),
            // Chemin vers le dossier dans lequel uploader. Si non existant, est créé automatiquement
            'path'       => 'foo/covers/'.$this->id,
            // Liste des thumbnails à générer si le fichier est une image
            'thumbnails' => ['xs' => 150, 'sm' => 300, 'md' => 800],
        ],
        'bar' => [
            'name' => 'bar-'.$this->id,
            'path' => 'foo/bar/'.$this->id,
        ],
    ];
}
```

```php
/**
 * @param string $attribute
 * @param UploadedFile|InterventionImage $file
 * @param string|null $extension Pas besoin de le préciser si $file est un UploadedFile
 *
 * @return bool|null
 */
public function attachFile(string $attribute, $file = null, string $extension = null)
```

```php
// Exemple
$foo = Foo::create([
    'name'        => 'Lorem ipsum',
    'description' => 'Fusce risus nisl viverra et',
]);

$foo->attachFile('cover', $request->file('cover'));
$foo->attachFile('bar', $request->file('bar'));
```

### Supprimer un fichier

Pour supprimer un fichier utiliser `deleteAttachedFile()`

```php
$foo->deleteAttachedFile('cover', $request->file('cover'));
```

### Récupérer un fichier

Pour récupérer un fichier utiliser `getAttachedFile()`

```php
/**
 * @param string $attribute
 *
 * @return string
 */
public function getAttachedFile(string $attribute)
```

### Récupérer une thumbnail

Si le fichier est une image, pour récupérer une thumbnail utiliser `getThumbnail()`

```php
/**
 * @param string $attribute
 * @param string $thumbnail
 *
 * @return string
 */
public function getThumbnail(string $attribute, string $thumbnail)

// Exemple
<img src="{{ asset_cache($firm->getThumbnail('cover', 'sm')) }}">
```

## HasData - `App\Models\Traits\HasData`

Permet d'attribuer à un model un tableau de data avec une whitelist de valeurs. Tout data non défini dans ce tableau n'est pas pris en compte.  
L'attribut `data` est accessible comme n'importe quel attribut du model.  
Cet attribut est casté comme un array et enregistré en json en bdd.

Définir la méthode `defaultData()` avec les data autorisés et leurs valeurs par défaut.  

```php
// A placer dans le model
public function defaultData()
{
    return [
        'foo' => 'bar',
        'hello' => ['world', 'darkness my old friend'],
        'goodbye' => true,
    ];
}

// Exemple
$foo->data['goodbye'] = false; // Cette valeur sera modifiée
$foo->data['toast'] = 'Oui'; // Cette valeur ne sera pas ajoutée au tableau
```

### Migration

```php
$table->text('data')->default('{}');
```

## HasSettings - `App\Models\Traits\HasSettings`

Identitique que [HasData](#hasdata-app-models-traits-hasdata) mais avec un attribut nommé `settings`

# 🔧 Helpers

> `App\Support\helpers.php`

* [asset_cache()](#asset_cache)
* [settings()](#settings)
* [hlrt_is()](#hlrt_is)
* [hlrt_begins_with()](#hlrt_begins_with)
* [hlrt_has_params()](#hlrt_has_params)
* [hl_url_his()](#hl_url_is)
* [hl_url_has_params()](#hl_url_has_params)

#### asset_cache()

```php
/**
 * Ajouter à l'url d'un asset son filemtime pour que les navigateurs le mettent à jour automatiquement si le fichier
 * a été modifié
 *
 * @param  string $path
 * @param  bool $secure
 *
 * @return string
 */
function asset_cache(string $path, bool $secure = null)
```

#### settings()

```php
/**
 * Retourner un paramètre enregistré en base de donnée
 *
 * @param string $setting
 *
 * @return mixed
 *
 * @see SettingRepository::allCached()
 */
function settings(string $setting)
```

#### hlrt_is()

```php
/**
 * Retourne une class CSS si une route donnée correspond à la route actuelle
 *
 * @param string|array $route
 * @param string $class
 * @param string $default
 *
 * @return string
 */
function hlrt_is($route, string $class = 'active', string $default = '')
```

#### hlrt_begins_with()

```php
/**
 * Retourne une class CSS si la route actuelle commence avec une chaine de caractères donnée
 *
 * @param string|array $beginWith
 * @param string $class
 * @param string $default
 *
 * @return string
 */
function hlrt_begins_with($beginWith, string $class = 'active', string $default = '')
```

#### hlrt_has_params()

```php
/**
 * Retourne une class CSS si la route actuelle comporte certains paramètres donnés
 * $params est un tableau $clef => $valeur, ou $clef est le nom du paramètre GET et $valeur… sa valeur
 * $valeur peut aussi être un tableau de plusieurs valeurs
 *
 * @param array $params
 * @param string $class
 * @param string $default
 *
 * @return string
 */
function hlrt_has_params(array $params, string $class = 'active', string $default = '')
```

#### hl_url_is()

```php
/**
 * Retourne une class CSS si l'url donnée correspond à l'url actuelle
 *
 * @param string|array $url
 * @param string $class
 * @param string $default
 *
 * @return string
 */
function hl_url_is($url, string $class = 'active', string $default = '')
```


#### hl_url_has_params()

```php
/**
 * Retourne une class CSS si l'url actuelle comporte certains paramètres donnés
 * $params est un tableau $clef => $valeur, ou $clef est le nom du paramètre GET et $valeur… sa valeur
 * $valeur peut aussi être un tableau de plusieurs valeurs
 *
 * @param array $params
 * @param string $class
 * @param string $default
 *
 * @return string
 */
function hl_url_has_params(array $params, string $class = 'active', string $default = '')
```
