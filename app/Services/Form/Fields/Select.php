<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Select extends Field
{
	/**
	 * $selectedOptions = [
	 * 	'Label à afficher' => [
	* 		// La valeur de l'option
	* 		'value' => 42,
	* 		// Les potentiels attr html des options du select
	* 		'attr'  => [],
	 * 	]
	 * ]
	 *
	 * @var array
	 */
	public $selectOptions = [];

	public $placeholder = null;

	protected function setAllProperties(array $params)
	{
		parent::setAllProperties($params);

		foreach ($params['selectOptions'] ?? [] as $text => $optionParams) {
			$newOption = ['value' => null, 'text' => null, 'attr' => []];

			if (is_array($optionParams)) {
				$newOption['value'] = $optionParams['value'];
				$newOption['text']  = $text;
				unset($optionParams['text']);
				// Le reste est considéré comme des attr html
				$newOption['attr'] = $optionParams;
			} else {
				$newOption['value'] = $optionParams;
				$newOption['text']  = $text;
			}

			$this->selectOptions[] = $newOption;
		}

		$this->placeholder = $params['placeholder'] ?? null;
	}

	public function render()
	{
		return view($this->templatesPath . 'field.select', [
			'field' => $this,
		])->render();
	}
}
