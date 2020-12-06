<?php

namespace App\Services\Form\Fields;

use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class TextTranslatable extends Field
{
	public function render()
	{
		// S'assurer que toutes les langues sont présentes dans le tableau de values
		$defaultValues                          = array_fill_keys(array_keys(LaravelLocalization::getLocalesOrder()), null);
		$inputValue                             = !empty($this->input['attr']['value']) ? $this->input['attr']['value'] : [];
		$this->input['options']['translations'] = array_merge($defaultValues, $inputValue);
		// La valeur affichée dans l'input visible au chargement de la page est celle de la première langue définie
		$locales                      = LaravelLocalization::getLocalesOrder();
		$firstLocaleCode              = array_key_first($locales);
		$this->input['attr']['value'] = $this->input['options']['translations'][$firstLocaleCode];
		// Garder le "vrai" name de l'input en mémoire et ne pas en utiliser dans l'input visible
		$this->input['options']['inputName'] = $this->input['attr']['name'];
		$this->input['attr']['name']         = '';

		// === ERRORS ===

		// S'il existe des erreurs, les récupérer pour les traduire
		if ($this->options['displayErrors'] === true && Session::has('errors') && !empty($this->input['options']['inputName'])) {
			$inputErrorsKeys = [];
			$errors          = [];

			// Lister les noms de l'attribut suffixé par la locale récupéré depuis la Request ("my_input.fr, my_input.en" par exemple)
			foreach (array_keys($locales) as $locale) {
				$inputErrorsKeys[] = $this->input['options']['inputName'].'.'.$locale;
			}
			// Boucler sur les inputs pour traduire correctement l'erreur, pour afficher un msg du genre :
			// "Le champ title:fr est obligatoire." => "Le champ titre (fr) est obligatoire."
			foreach ($inputErrorsKeys as $inputErrorKey) {
				foreach (Session::get('errors')->get($inputErrorKey) as $error) {
					preg_match('/(.*)(name)\.(fr|en)(.*)/', $error, $matches);
					$errors[] = $matches[1].__('validation.attributes.'.$matches[2]).' ('.$matches[3].')'.$matches[4];
				}
			}

			$this->errors = $errors;
		}

		return view($this->templatesPath.'field.text_translatable', [
			'field' => $this,
		])->render();
	}
}
