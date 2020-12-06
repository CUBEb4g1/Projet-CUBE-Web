<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Textarea extends Field
{
	protected function setAllProperties(array $params)
	{
		parent::setAllProperties($params);

		$this->input['text'] = $this->input['attr']['value'];
		unset($this->input['attr']['value']);
	}

	public function render()
	{
		return view($this->templatesPath . 'field.textarea', [
			'field' => $this,
		])->render();
	}
}
