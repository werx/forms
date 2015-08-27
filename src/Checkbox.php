<?php

namespace werx\Forms;

/**
 * Class Checkbox
 * @package werx\Forms
 * @method Checkbox style($style) CSS Style Attributes
 * @method Checkbox class($class) CSS Classes to apply
 * @method Checkbox value($value) Default Value
 * @method Checkbox id($id) Element Id
 * @method Checkbox name($name) Element Name
 * @method Checkbox placeholder($value) Placeholder for input
 */
class Checkbox extends Input
{
	/**
	 * @param null $name
	 */
	public function __construct($name = null)
	{
		$this->attributes['type'] = 'checkbox';

		parent::__construct($name, false);

		return $this;
	}

	/**
	 * @return $this
	 */
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
			if (in_array($item_value, (array) $values)) {
				$this->checked();
			}
		}

		return $this;
	}

	/**
	 * @param null $value_1
	 * @param null $value_2
	 * @return $this
	 *
	 * @deprecated Deprecated the day after it was created. Use checkedWhen() instead.
	 */
	public function conditionalChecked($value_1 = null, $value_2 = null)
	{
		if (isset($value_1) && isset($value_2) && ($value_1 === $value_2)) {
			return $this->checked();
		} else {
			return $this;
		}
	}

	/**
	 * Check the item if the specified condition evaluates to true.
	 *
	 * @param bool $condition
	 * @return $this|Checkbox
	 */
	public function checkedWhen($condition = null)
	{
		if ($condition === true) {
			return $this->checked();
		} else {
			return $this;
		}
	}

	/**
	 * @return $this
	 */
	public function checked()
	{
		$this->attribute('checked', 'checked');

		return $this;
	}

	/**
	 * @return string
	 */
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
