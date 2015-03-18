<?php

namespace werx\Forms;

/**
 * Class SelectCounty
 * @package werx\Forms
 * @method SelectCounty style($style) CSS Style Attributes
 * @method SelectCounty class($class) CSS Classes to apply
 * @method SelectCounty value($value) Default Value
 * @method SelectCounty id($id) Element Id
 * @method SelectCounty name($name) Element Name
 * @method SelectCounty placeholder($value) Placeholder for input
 */
class SelectCounty extends Select
{
	protected $data;
	protected $label;
	protected $use_array_values = true;
	protected $state = 'AR';

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
		return DataSets::counties($this->state);
	}
}
