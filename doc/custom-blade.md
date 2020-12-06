# 💿 Directives Blade custom

> Des directives Blade personnalisées pour aider au développement

### `@form`

#### Utilisation de la directive

La directive `@form` génère un champ de formulaire, en ajoutant des classes bootstrap par défaut, en ajoutant les erreurs Laravel si existantes dans le formulaire.  
Voici la liste exhaustive des champs existants, chaque exemple utilise la totalité des options possibles pour l'exemple et la documentation. Il n'est pas du tout obligatoire de toutes les utiliser en application.

```php
// Une configuration minimale
@form('text', [
    'input' => ['name' => 'foo'],
])

// Une configuration complète
@form('textarea', [
    'label' => [
        // Si omis, automatiquement ajouté grâce à l'attr. "id" de l'input
        'for' => 'my-foo-input',
        // Si omis, automatiquement ajouté grâce à l'attr. "name" de l'input
        'text' => 'Lorem ipsum<br><small>Consectetur adipisicing elit</small>'
    ],
    'input' => [
        // Attribut "name" de l'input
        'name' => 'foo',
        // Attribut "value" de l'input
        'value' => old('foo') ?? $model->foo,
        // Attribut ajouté à l'input. Vous pouvez ajouter absolument n'importe quel attribut html.
        'data-bar' => $bar,
        // Si omis, automatiquement généré sous la forme input_`name de l'input`
        'id' => 'my-foo-input',
        // Si options['defaultClass'] = true, cet attr. est concaténé avec les classes de base de l'input
        'class' => 'js-simple-editor w-100',
        // Un autre attribut html ajouté
        'rows' => 25,
        // Un autre attribut html ajouté
        'required'
    ],
    'options' => [
        // Générer des classes par défaut (pour Bootstrap en général)
        'defaultClass' => true,
        // Afficher ou non les erreurs renvoyées par Laravel
        'displayErrors' => true,
    ]
])
```

```php
// Champ text
@form('text', [
    'label' => ['text' => 'Votre nom de famille'],
    'input' => ['name' => 'firstname', 'value' => $firstname],
])
```

```php
// Champ text traduisible
@form('textTranslatable', [
	'label' => ['text' => 'Votre nom de famille'],
	'input' => ['name' => 'firstname', 'value' => $firstname],
])

// Bouton pour basculer dans une langue tous les champs traduisibles
@include('_partials.form.lang_btn')
```

```php
// Champ email
@form('email', [
    'label' => ['text' => 'Votre email'],
    'input' => ['name' => 'email', 'value' => $email],
])
```

```php
// Champ number
@form('number', [
    'label' => ['text' => 'Votre âge'],
    'input' => ['name' => 'age', 'value' => $age],
])
```

```php
// Champ tel
@form('tel', [
    'label' => ['text' => 'Votre numéro de téléphone'],
    'input' => ['name' => 'tel', 'value' => $tel],
])
```

```php
// Champ hidden
@form('hidden', [
    'input' => ['name' => 'id', 'value' => $id],
])
```

```php
// Champ password
@form('password', [
    'label' => ['text' => 'Votre mot de passe'],
    'input' => ['name' => 'password', 'value' => $password],
])
```

```php
// Champ password, avec un bouton de toggle pour afficher ou non le mot de passe
// Si le script ne se déclenche pas, vérifier que la section @stack('scripts') est bien définie quelque part dans le layout
@form('passwordToggle', [
    'label' => ['text' => 'Votre mot de passe'],
    'input' => ['name' => 'password', 'value' => $password],
])
```

```php
// Champ textarea
@form('textarea', [
    'label' => ['text' => 'Présentez vous'],
    'input' => ['name' => 'description', 'value' => $description],
])
```

```php
// Champ checkbox
@form('checkbox', [
    'label' => ['text' => "Accéder au backoffice"],
    'input' => [
        'id' => 'permission-42',
        'name' => 'permissions[]',
        'value' => 42,
        'checked' => true,
        'checkedByVal' => 42, // si cette valeur est égale à "value" la case est cochée
        'disabled' => false,
    ],
])
```

```php
// Champ radio
@form('radio', [
    'label' => ['text' => "Recevoir les alertes sms"],
    'input' => [
        'id' => 'email-alerts-yes',
        'name' => 'email_alerts',
        'value' => 1,
        'checked' => false,
        'checkedByVal' => 1, // si cette valeur est égale à "value" la case est cochée
        'disabled' => false,
    ],
])

@form('radio', [
    'label' => ['text' => "Ne pas recevoir les alertes sms"],
    'input' => [
        'id' => 'email-alerts-no',
        'name' => 'email_alerts',
        'value' => 0,
    ],
])
```

```php
// Champ select
@form('select', [
    'label' => ['text' => 'Département recherché'],
    'input' => [
        'name' => 'department',
        'value' => 21,
    ],
    // Les options du select
    // - soit passer directement la valeur
    // - soit passer un array pour pouvoir ajouter des attr. html sur la balise <option>
    'selectOptions' => [
        "Côte-d'Or" => 21,
        'Yonne' => 89,
        'Réunion' => ['value' => 974, 'data-outremer' => true]
    ],
    'placeholder' => '-',
])
```

#### Créer un nouveau type de champ

Chaque type de champ doit possèder sa classe dans `App\Services\Form\Fields` et est hérité de `App\Services\Form\Fields\Field`.  
La classe doit posséder la méthode `render()` qui retourne une vue blade. Toutes les vues sont localisées dans `resources/views/_partials/form/field`.  
Voir les classes existantes pour plus d'informations et d'exemples.
