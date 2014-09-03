<?php

namespace werx\Forms;

class Button extends Input
{
	protected $label = 'Submit';
	
	public function __toString()
	{
		$attribute_parts = [];
 
		foreach($this->attributes as $k => $v)
		{
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}
 
		$attribute_html = join(' ', $attribute_parts);
		
		return sprintf('<button %s>%s</button>', $attribute_html, $this->label);
	}
}
