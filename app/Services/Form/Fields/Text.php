<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Text extends Field
{
	public function render()
	{
		return view($this->templatesPath . 'field.text', [
			'field' => $this,
		])->render();
	}
}
