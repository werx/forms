<?php

namespace werx\Forms;

class Checkbox extends Input
{
	public function __construct($name = null)
	{
		$this->attributes['type'] = 'checkbox';

		parent::__construct($name, false);

		return $this;
	}

	public function isChecked()
	{
		$name = $this->getAttribute('name');

		$values = Form::getValue($name, [], false);

		$item_value = $this->getAttribute('value');

		$type = $this->getAttribute('type');

		if ($type == 'radio') {
			if (!empty($values) && $item_value == $values) {
				$this->checked();
			}
		} elseif ($type == 'checkbox') {
			if (in_array($item_value, $values)) {
				$this->checked();
			}
		}

		return $this;
	}

	public function checked()
	{
		$this->attribute('checked', 'checked');

		return $this;
	}

	public function __toString()
	{
		$this->isChecked();

		$attribute_parts = [];

		foreach ($this->attributes as $k => $v) {
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}

		return sprintf('<input %s />', join(' ', $attribute_parts));
	}
}
