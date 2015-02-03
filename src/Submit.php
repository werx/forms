<?php

namespace werx\Forms;

/**
 * Class Submit
 * @package werx\Forms
 * @method Submit style($style) CSS Style Attributes
 * @method Submit class($class) CSS Classes to apply
 * @method Submit value($value) Default Value
 * @method Submit id($id) Element Id
 * @method Submit name($name) Element Name
 * @method Submit placeholder($value) Placeholder for input
 */
class Submit extends Button
{
	public function __construct($name = null, $id = null)
	{
		$this->attributes['type'] = 'submit';

		return parent::__construct($name, $id);
	}
}
