<?php

namespace werx\Forms;

/**
 * Class SelectState
 * @package werx\Forms
 * @method SelectState style($style) CSS Style Attributes
 * @method SelectState class($class) CSS Classes to apply
 * @method SelectState value($value) Default Value
 * @method SelectState id($id) Element Id
 * @method SelectState name($name) Element Name
 * @method SelectState placeholder($value) Placeholder for input
 */
class SelectState extends Select
{
	protected $data;
	protected $label;
	protected $use_array_values = false;

	/**
	 * @param bool $value
	 * @return $this
	 */
	public function useDisplayNameForValue($value = true)
	{
		$this->use_array_values = $value;
		return $this;
	}

	protected function getDefaultData()
	{
		return DataSets::states();
	}
}
