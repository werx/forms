<?php

namespace werx\Forms;

/**
 * Class Label
 * @package werx\Forms
 *
 * @method $this style($style) CSS Style Attributes
 * @method $this class($class) CSS Classes to apply
 * @method $this label($label) Label Display Value
 * @method $this id($id) Element Id
 * @method $this for($for) Sets the ID of the element to which the label should be bound.
 * @method $this accesskey($accesskey) Defines a hot key with which you can go to the attached to the label (through a for attribute) form element.
 */
class Label extends Input
{
	protected $label;

	/**
	 * @param null $label
	 * @param null $for
	 */
	public function __construct($label = null, $for = null)
	{

		Form::getInstance();

		$this->label = $label;

		if ($for !== null) {
			$this->attribute('for', $for);
		}

		return $this;
	}

	public function __toString()
	{
		$attribute_parts = [];

		foreach ($this->attributes as $k => $v) {
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}

		$attribute_html = join(' ', $attribute_parts);

		$string = sprintf('<label %s>%s</label>', $attribute_html, $this->label);

		// Get rid of extra space if no bound element id provided.
		return str_replace('<label >', '<label>', $string);
	}
}
