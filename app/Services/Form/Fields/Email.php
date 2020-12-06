<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Email extends Field
{
	public function render()
	{
		return view($this->templatesPath . 'field.email', [
			'field' => $this,
		])->render();
	}
}
