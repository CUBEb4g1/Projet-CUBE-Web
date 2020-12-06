<?php

namespace App\Services\Form\Fields;

/**
 * @version 0.1
 *
 * @author Alexis Weber
 */
class Tel extends Field
{
	public function render()
	{
		return view($this->templatesPath . 'field.tel', [
			'field' => $this,
		])->render();
	}
}
