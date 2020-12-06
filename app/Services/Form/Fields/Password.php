<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Password extends Field
{
	public function render()
	{
		return view($this->templatesPath . 'field.password', [
			'field' => $this,
		])->render();
	}
}
