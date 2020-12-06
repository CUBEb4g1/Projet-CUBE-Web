<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Number extends Field
{
	public function render()
	{
		return view($this->templatesPath . 'field.number', [
			'field' => $this,
		])->render();
	}
}
