<?php

namespace werx\Forms;

class Select extends Input
{
	protected $data;
	protected $label;
	protected $use_array_values = false;

	public function selected($value)
	{
		return $this->value($value);
	}

	public function data($data = [], $use_array_values = false) {
		$this->data = $data;
		$this->use_array_values = $use_array_values;
		return $this;
	}

	public function label($display, $value = '')
	{
		$this->label = (object) array('display' => $display, 'value' => $value);

		return $this;
	}

	public function __toString()
	{
		$selected = $this->getValue()->getAttribute('value');

		$attribute_parts = [];

		$html = [];

		foreach ($this->attributes as $k => $v) {

			if ($k == 'value') {
				continue;
			}

			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}

		$html[] = sprintf('<select %s>', join(' ', $attribute_parts));
		
		$options = [];

		if (!empty($this->label)) {
			$options[] = sprintf('<option value="%s">%s</option>', $this->label->value, $this->label->display);
		}

		foreach ($this->data as $k => $v) {

			if ($this->use_array_values) {
				// Using the array value as the option value, instead of the array index.
				$k = $v;
			}

			if ($k == $selected) {
				$options[] = sprintf('<option selected="selected" value="%s">%s</option>', $k, $v);
			} else {
				$options[] = sprintf('<option value="%s">%s</option>', $k, $v);
			}
		}

		$html[] = join('', $options);
		$html[] = '</select>';
		
		return join('', $html);
	}
}
