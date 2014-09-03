<?php

namespace werx\Forms;

class Submit extends Button
{
	public function __construct($name = null, $id = null)
	{
		$this->attributes['type'] = 'submit';

		return parent::__construct($name, $id);
	}
}
