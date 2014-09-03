<?php

namespace werx\Forms;

class Select extends Input
{
	protected $attributes;
	protected $value;
	protected $data;

	public function selected($value)
	{
		return $this->value($value);
	}

	public function __toString()
	{
		$attribute_parts = [];
 
		$html = [];
		
		foreach($this->attributes as $k => $v)
		{
			$attribute_parts[] = sprintf('%s="%s"', $k, $v);
		}
 
		$html[] = sprintf('<select %s>', join(' ', $attribute_parts));
		
		$options = [];

		foreach ($this->data as $k => $v) {

			if ($k == $this->value) {
				$options[] = sprintf('<option selected="selected" value="%s">%s</option>', $k, $v);					
			} else {
				$options[] = sprintf('<option value="%s">%s</option>', $k, $v);	
			}
		}

		$html[] = join('', $options);
		$html[] = '</select>';
		
		return join('', $html);
	}
}
