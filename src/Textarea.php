<?php

namespace werx\Forms;

/**
 * Class Textarea
 * @package werx\Forms
 * @method Textarea style($style) CSS Style Attributes
 * @method Textarea class($class) CSS Classes to apply
 * @method Textarea value($value) Default Value
 * @method Textarea id($id) Element Id
 * @method Textarea name($name) Element Name
 * @method Textarea placeholder($value) Placeholder for input
 */
class Textarea extends Input
{
	public function __construct($name = null, $id = null)
	{
		parent::__construct($name, $id);

		return $this;
	}

	public function __toString()
	{
		$attribute_parts = [];

		$value = $this->getValue()->getAttribute('value');

		unset($this->attributes['value']);

		foreach ($this->attributes as $k => $v) {
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}

		return sprintf('<textarea %s>%s</textarea>', join(' ', $attribute_parts), $value);
	}
}
