<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Hidden extends Field
{
	public function render()
	{
		return view($this->templatesPath . 'field.hidden', [
			'field' => $this,
		])->render();
	}
}
