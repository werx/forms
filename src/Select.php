<?php

namespace werx\Forms;

/**
 * Class Select
 *
 * @package werx\Forms
 * @method Select style($style) CSS Style Attributes
 * @method Select class($class) CSS Classes to apply
 * @method Select value($value) Default Value
 * @method Select id($id) Element Id
 * @method Select name($name) Element Name
 * @method Select placeholder($value) Placeholder for input
 */
class Select extends Input
{
	protected $data;
	protected $label;
	protected $use_array_values = false;

	/**
	 * @param $value
	 * @return $this
	 */
	public function selected($value)
	{
		return $this->value($value);
	}

	/**
	 * @param array $data
	 * @param bool $use_array_values
	 * @return $this
	 */
	public function data($data = [], $use_array_values = false)
	{
		$this->data = $data;
		$this->use_array_values = $use_array_values;
		return $this;
	}

	/**
	 * @param $display
	 * @param string $value
	 * @return $this
	 */
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

		if (empty($this->data)) {
			$this->data = $this->getDefaultData();
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

	/**
	 * Overridden in child classes: SelectCounty, SelectState
	 * @return array
	 */
	protected function getDefaultData()
	{
		return [];
	}
}
