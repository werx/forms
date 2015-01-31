<?php

namespace werx\Forms;

class SelectCounty extends Select
{
	protected $data;
	protected $label;
	protected $use_array_values = true;
	protected $state = 'AR';

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
	 * @param string $state
	 * @return $this
	 */
	public function forState($state = 'AR')
	{
		$this->state = $state;

		return $this;
	}

	/**
	 * @return mixed
	 */
	protected function getDefaultData()
	{
		return Data::counties($this->state);
	}
}
