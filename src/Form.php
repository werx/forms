<?php

namespace werx\Forms;

/**
 * Class Form
 * @package werx\Forms
 *
 * @TODO Add radio, checkbox, and textarea support.
 */
class Form
{
	public $data;
	public static $instance;

	public function __construct()
	{
		$this->data = [];
		return $this;
	}

	/**
	 * @return mixed
	 */
	public static function getInstance()
	{
		if (empty(static::$instance)) {
			static::$instance = new Form();
		}

		return static::$instance;
	}

	/**
	 *
	 */
	public static function clear()
	{
		static::$instance = null;
		$instance = static::getInstance();
		$instance->data = [];
	}

	/**
	 * @param array $content
	 */
	public static function setData($content = [])
	{
		$instance = static::getInstance();

		if (!empty($content) && is_array($content)) {
			foreach ($content as $key => $value) {
				$instance->data[$key] = $value;
			}
		}
	}

	/**
	 * @return mixed
	 */
	public static function getData()
	{
		$instance = static::getInstance();

		return $instance->data;
	}

	/**
	 * @param null $key
	 * @param string $default
	 * @param bool $escape
	 * @return string
	 */
	public static function getValue($key = null, $default = '', $escape = true)
	{
		$instance = static::getInstance();

		// Handle arrays such as checkbox groups.
		$key = str_replace('[]', '', $key);

		$value = array_key_exists($key, $instance->data) ? $instance->data[$key] : $default;

		if ($escape === true) {
			return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
		} else {
			return $value;
		}
	}

	/**
	 * @param array $options
	 * @return string
	 */
	public static function open($options = [])
	{
		$html = [];

		foreach ($options as $key => $value) {
			$html[] = sprintf('%s="%s"', $key, $value);
		}

		return '<form ' . join(' ', $html) . '>';
	}

	/**
	 * @return string
	 */
	public static function close()
	{
		return '</form>';
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Input
	 */
	public static function text($name = null, $id = null)
	{
		return (new Input($name, $id))->attribute('type', 'text');
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Input
	 */
	public static function hidden($name = null, $id = null)
	{
		return (new Input($name, $id))->attribute('type', 'hidden');
	}

	/**
	 * @param null $name Input Name
	 * @param null $id Input Id
	 * @return \werx\Forms\Input
	 */
	public static function password($name = null, $id = null)
	{
		return (new Input($name, $id))->attribute('type', 'password');
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Input
	 */
	public static function email($name = null, $id = null)
	{
		return (new Input($name, $id))->attribute('type', 'email');
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Input
	 */
	public static function tel($name = null, $id = null)
	{
		return (new Input($name, $id))->attribute('type', 'tel');
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Input
	 */
	public static function url($name = null, $id = null)
	{
		return (new Input($name, $id))->attribute('type', 'url');
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Textarea
	 */
	public static function textarea($name = null, $id = null)
	{
		return new Textarea($name, $id);
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Select
	 */
	public static function select($name = null, $id = null)
	{
		return new Select($name, $id);
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\SelectState
	 */
	public static function selectState($name = null, $id = null)
	{
		return new SelectState($name, $id);
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\SelectCounty
	 */
	public static function selectCounty($name = null, $id = null)
	{
		return new SelectCounty($name, $id);
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Submit
	 */
	public static function submit($name = null, $id = null)
	{
		return new Submit($name, $id);
	}

	/**
	 * @param null $name
	 * @param null $id
	 * @return \werx\Forms\Button
	 */
	public static function button($name = null, $id = null)
	{
		return new Button($name, $id);
	}

	/**
	 * @param null $name
	 * @return \werx\Forms\Checkbox
	 */
	public static function radio($name = null)
	{
		return (new Checkbox($name))->attribute('type', 'radio');
	}

	/**
	 * @param null $name
	 * @return \werx\Forms\Checkbox
	 */
	public static function checkbox($name = null)
	{
		return new Checkbox($name);
	}

	/**
	 * @param $key
	 * @param null $value
	 * @param string $checked_html
	 * @return string
	 */
	public static function getChecked($key, $value = null, $checked_html = 'checked = "checked"')
	{
		$instance = static::getInstance();

		$selected = $instance->getValue($key, null, false);

		$checked = false;

		if (is_array($selected)) {
			if (in_array($value, $selected)) {
				$checked = true;
			}
		} elseif (!empty($selected) && $selected == $value) {
			$checked = true;
		}

		return $checked ? $checked_html : null;
	}

	/**
	 * @param $key
	 * @param null $value
	 * @param string $checked_html
	 * @return string
	 */
	public static function getSelected($key, $value = null, $checked_html = 'selected = "selected"')
	{
		return static::getChecked($key, $value, $checked_html);
	}
}
