<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class File extends Field
{
	protected function setAllProperties(array $params)
	{
		parent::setAllProperties($params);

		// Classe pour Bootstrap
		if ($this->options['defaultClass'] === true) {
			$this->input['attr']['class'] = 'custom-file-input '.($this->input['attr']['class'] ?? '');
		}
	}

	public function render()
	{
		return view($this->templatesPath.'field.file', [
			'field' => $this,
		])->render();
	}
}
