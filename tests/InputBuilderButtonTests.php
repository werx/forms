<?php
namespace werxFormsTests;

use werx\Forms\Form;

class InputBuilderButtonTests extends \PHPUnit_Framework_TestCase
{
	public function testButtonBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::button('test');
		$expected = '<button name="test" id="test">Submit</button>';

		$this->assertEquals($expected, $actual);
	}

	public function testButtonBuildsExpectedHtmlWithCustomLabel()
	{
		Form::clear();

		$actual = (string) Form::button('test')->label('Back');
		$expected = '<button name="test" id="test">Back</button>';

		$this->assertEquals($expected, $actual);
	}

	public function testSubmitBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::submit('test');
		$expected = '<button type="submit" name="test" id="test">Submit</button>';

		$this->assertEquals($expected, $actual);
	}

	public function testSubmitBuildsExpectedHtmlWithCustomLabel()
	{
		Form::clear();

		$actual = (string) Form::submit('test')->label('Search');
		$expected = '<button type="submit" name="test" id="test">Search</button>';

		$this->assertEquals($expected, $actual);
	}
}
