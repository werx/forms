<?php

namespace werx\Forms;

class Data
{
	/**
	 * @return mixed
	 */
	public static function states()
	{
		$path = sprintf('%s/states.json', self::getStorageDirectory());
		return static::getData($path);
	}

	/**
	 * @param string $state
	 * @return mixed
	 */
	public static function counties($state = 'AR')
	{
		$state = strtoupper($state);
		$path = sprintf('%s/counties/%s.json', self::getStorageDirectory(), $state);
		return static::getData($path);
	}

	/**
	 * @param null $path
	 * @return mixed
	 */
	protected static function getData($path = null)
	{
		return json_decode(file_get_contents($path));
	}

	/**
	 * @return string
	 */
	protected static function getStorageDirectory()
	{
		return dirname(dirname(__FILE__)) . '/storage';
	}
}
