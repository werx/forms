<?php

namespace werx\Forms;

/**
 * Class Button
 * @package werx\Forms
 * @method Button style($style) CSS Style Attributes
 * @method Button class($class) CSS Classes to apply
 * @method Button value($value) Default Value
 * @method Button id($id) Element Id
 * @method Button name($name) Element Name
 * @method Button placeholder($value) Placeholder for input
 */
class Button extends Input
{
	protected $label = 'Submit';
	
	public function __toString()
	{
		$attribute_parts = [];

		foreach ($this->attributes as $k => $v) {
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}

		$attribute_html = join(' ', $attribute_parts);
		
		return sprintf('<button %s>%s</button>', $attribute_html, $this->label);
	}
}
