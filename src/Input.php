<?php

namespace werx\Forms;

/**
 * Class Input
 * @package werx\Forms
 *
 * @method style($style) CSS Style Attributes
 * @method class($class) CSS Classes to apply
 * @method value($value) Default Value
 * @method id($id) Element Id
 * @method name($name) Element Name
 */
class Input
{
	protected $attributes = [];
 	protected $form;

	public function __construct($name = null, $id = null)
	{
		Form::getInstance();

		if ($id == null) {
			$id = $name;
		}

		$this->attribute('name', $name);

		if ($id !== false) {
			$this->attribute('id', $id);
		}

		return $this;	
	}

	public function getValue($default = null, $escape = true){
		$value = Form::getValue($this->attributes['name'], $default, $escape);

		if ($escape === true) {
			$value = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
		}

		$this->value($value);

		return $this;
	}

	public function required()
	{
		$this->attribute('required', 'required');

		return $this;
	}

	public function attribute($key, $value = null)
	{
		$this->attributes[$key] = $value;
 
		return $this;
	}

	public function getAttribute($key, $default = null)
	{
		return array_key_exists($key, $this->attributes) ? $this->attributes[$key] : $default;
	}

	/**
	 * @param $method
	 * @param array $value
	 * @return $this
	 */
	public function __call($method, $value=[])
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
		$attribute_parts = [];
 
		foreach($this->attributes as $k => $v)
		{
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}
 
		return sprintf('<input %s />', join(' ', $attribute_parts));
	}
}
