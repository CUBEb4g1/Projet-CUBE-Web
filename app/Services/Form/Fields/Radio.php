<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Radio extends Field
{
	protected function setAllProperties(array $params)
	{
		parent::setAllProperties($params);

		// Classe pour Bootstrap
		if ($this->options['defaultClass'] === true) {
			$this->label['attr']['class'] = 'custom-control-label ' . ($this->label['attr']['class'] ?? '');
			$this->input['attr']['class'] = 'custom-control-input ' . ($params['input']['class'] ?? '');
		}

		// Passer certains attr en tant que simple boolean
		$checked      = $this->input['attr']['checked'] ?? null;
		$checkedByVal = $this->input['attr']['checkedByVal'] ?? null;
		$disabled     = $this->input['attr']['disabled'] ?? null;
		unset($this->input['attr']['checkedByVal']);

		if (is_bool($checked) || $checked === null) {
			if ($checked === true || $checkedByVal === $this->input['attr']['value']) {
				$this->input['attr'][] = 'checked';
			}
			unset($this->input['attr']['checked']);
		}

		if (is_bool($disabled) || $disabled === null) {
			if ($disabled === true) {
				$this->input['attr'][] = 'disabled';
			}
			unset($this->input['attr']['disabled']);
		}
	}

	public function render()
	{
		return view($this->templatesPath.'field.radio', [
			'field' => $this,
		])->render();
	}
}
