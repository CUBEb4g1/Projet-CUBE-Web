<?php

namespace App\Services\Form\Fields;

use App\Services\Form\Interfaces\FieldInterface;
use App\Services\Form\Traits\HasAttributes;
use Illuminate\Support\Facades\Session;

/**
 * Générer des champs de formulaire HTML
 *
 * @version 0.1
 *
 * @author Alexis Weber
 */
abstract class Field implements FieldInterface
{
	use HasAttributes;

	/**
	 * Erreurs retournées par Laravel pour ce champ de formulaire
	 *
	 * @var array
	 */
	public $errors = [];
	/**
	 * Options générales pour la génération du champ
	 *
	 * @var array
	 */
	public $options = [
		// Générer des classes par défaut (pour Bootstrap en général)
		'defaultClass'  => true,
		// Afficher ou non les erreurs renvoyées par Laravel
		'displayErrors' => true,
	];
	/**
	 * Options et paramètres de l'input du champ
	 *
	 * @var array
	 */
	public $input = [
		'attr' => [
			'name'  => null,
			'value' => null,
			'id'    => null,
			'class' => null,
		],
	];
	/**
	 * Options et paramètres du label du champ
	 *
	 * @var array
	 */
	public $label = [
		'text' => null,
		'attr' => [
			'for'   => null,
			'class' => null,
		],
	];
	/**
	 * Emplacement des vues Blade
	 *
	 * @var string
	 */
	protected $templatesPath = '_partials.form.';

	public function __construct(array $params)
	{
		$this->setAllProperties($params);
	}

	/**
	 * Selon $field, aller chercher la bonne classe
	 * Text, Email, Number etc…
	 *
	 * @param string $field
	 * @param array $params
	 *
	 * @return mixed
	 */
	public static function field(string $field, array $params)
	{
		/* @var $instance Field */
		$class    = 'App\Services\Form\Fields\\'.ucfirst($field);
		$instance = new $class($params);

		return $instance->render();
	}

	/**
	 * Selon les paramètres passés, hydrater correctement les paramètres
	 * TODO: Refactorer cette partie avec des classes
	 *
	 * @param array $params
	 */
	protected function setAllProperties(array $params)
	{
		// Juste plus pratique
		$input = $params['input'] ?? [];
		$label = $params['label'] ?? null;

		// === ERRORS ===

		// S'il existe des erreurs, les enregistrer
		if ($this->options['displayErrors'] === true && Session::has('errors') && isset($input['name'])) {
			$this->errors = Session::get('errors')->get($input['name']);
		}

		// === OPTIONS ===

		// Merger les options
		$this->options = array_merge($this->options, $params['options'] ?? []);

		// === INPUT ===

		// Merger les attributs pour l'input
		foreach ($this->input['attr'] as $key => $attr) {
			$this->input['attr'][$key] = $input[$key] ?? $this->input['attr'][$key];
		}
		// Attribuer automatiquement un champ id
		$this->input['attr']['id'] = $this->input['attr']['id'] ?? 'input_'.($input['name'] ?? null);
		// Attribuer automatiquement les class de Bootstrap
		if ($this->options['defaultClass'] === true) {
			$this->input['attr']['class'] = 'form-control '.$this->input['attr']['class'];
			// Si existe des erreurs
			if (!empty($this->errors)) {
				$this->input['attr']['class'] .= ' is-invalid';
			}
		}
		// Merger les attr passés en plus
		$this->input['attr'] = array_merge($this->input['attr'], array_diff_key($input, $this->input['attr']));

		// === LABEL ===

		if ($label !== null) {
			// Merger les attributs pour le label
			foreach ($this->label['attr'] as $key => $attr) {
				$this->label['attr'][$key] = $label[$key] ?? $this->label['attr'][$key];
			}
			// Attribuer automatiquement le champ for en rapport avec l'id
			$this->label['attr']['for'] = $this->label['attr']['for'] ?? $this->input['attr']['id'] ?? 'input_'.$this->input['attr']['name'];
			// Attribuer le text du label
			$this->label['text'] = $label['text'] ?? $this->input['attr']['name'];
			// Ajouter une classe is-required au label si l'input possède l'attr required
			if ($this->options['defaultClass'] === true) {
				if (in_array('required', $this->input['attr'], true)) {
					$this->label['attr']['class'] = 'is-required ' . $this->label['attr']['class'];
				}
			}
			// Merger les attr passés en plus
			$this->label['attr'] = array_merge($this->label['attr'], array_diff_key(array_diff_key($label, array_flip(['text'])), $this->label['attr']));
		} else {
			$this->label = null;
		}
	}
}
