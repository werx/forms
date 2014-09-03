<?php

namespace werx\Forms;

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

		$value = $this->getAttribute('value');

		if (!empty($value)) {
			unset($this->attributes['value']);
		}

		foreach($this->attributes as $k => $v)
		{
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}

		return sprintf('<textarea %s>%s</textarea>', join(' ', $attribute_parts), $value);
	}
}
