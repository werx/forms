<?php

namespace werx\Forms;

/**
 * Class Input
 * @package werx\Forms
 *
 * @method $this style($style) CSS Style Attributes
 * @method $this class($class) CSS Classes to apply
 * @method $this value($value) Default Value
 * @method $this id($id) Element Id
 * @method $this name($name) Element Name
 * @method $this placeholder($value) Placeholder for input
 */
class Input
{
	protected $attributes = [];

	/**
	 * @param null $name
	 * @param null $id
	 */
	public function __construct($name = null, $id = null)
	{
		Form::getInstance();

		if ($id == null) {
			$id = preg_replace('/[^0-9A-Za-z_-]*/', '', $name);
		}

		$this->attribute('name', $name);

		if ($id !== false) {
			$this->attribute('id', $id);
		}

		return $this;
	}

	/**
	 * Filters a variable reference for XSS.
	 * 
	 * @param $value
	 * @return string
	 */
	protected function filter(&$value)
	{
		if (is_scalar($value)) {
			return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
		} elseif (is_array($value)){
			array_walk_recursive($value, [$this, 'filter']);
		} elseif (is_object($value)) {
			foreach (get_object_vars($value) as $k => $v) {
				$value->$k = $this->filter($value);
			}
		}

		return $value;
	}

	/**
	 * @param null $default
	 * @param bool $escape
	 * @return $this
	 */
	public function getValue($default = null, $escape = true)
	{
		// First, see if there is already a value attribute. If so, use it.
		$value = $this->getAttribute('value');

		if (empty($value)) {
			$value = Form::getValue($this->attributes['name'], $default, $escape);
		}

		if ($escape === true) {
			$this->filter($value);
		}

		$this->attribute('value', $value);

		return $this;
	}

	/**
	 * @return $this
	 */
	public function required()
	{
		$this->attribute('required', 'required');

		return $this;
	}

	/**
	 * @param $key
	 * @param null $value
	 * @return $this
	 */
	public function attribute($key, $value = null)
	{
		$this->attributes[$key] = $value;

		return $this;
	}

	/**
	 * @param $key
	 * @param null $default
	 * @return null
	 */
	public function getAttribute($key, $default = null)
	{
		return array_key_exists($key, $this->attributes) ? $this->attributes[$key] : $default;
	}

	/**
	 * @param $method
	 * @param array $value
	 * @return $this
	 */
	public function __call($method, $value = [])
	{
		if (property_exists($this, $method)) {
			$this->$method = $value[0];
			return $this;
		} else {
			return $this->attribute($method, $value[0]);
		}
	}

	public function __toString()
	{
		$value = $this->getValue()->getAttribute('value');

		if (empty($value)) {
			unset($this->attributes['value']);
		}

		$attribute_parts = [];

		foreach ($this->attributes as $k => $v) {
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}

		return sprintf('<input %s />', join(' ', $attribute_parts));
	}
}
