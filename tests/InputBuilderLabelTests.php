<?php
namespace werx\FormsTests;

use werx\Forms\Form;

class InputBuilderLabelTests extends \PHPUnit_Framework_TestCase
{
	public function testBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::label('My Label', 'control_id');
		$expected = '<label for="control_id">My Label</label>';

		$this->assertEquals($expected, $actual);
	}

	public function testBuildsExpectedHtmlNoLabel()
	{
		Form::clear();

		$actual = (string) Form::label(null, 'control_id');
		$expected = '<label for="control_id"></label>';

		$this->assertEquals($expected, $actual);
	}

	public function testBuildsExpectedHtmlNoForId()
	{
		Form::clear();

		$actual = (string) Form::label('My Label');
		$expected = '<label>My Label</label>';

		$this->assertEquals($expected, $actual);
	}

	public function testBuildsExpectedHtmlDefaultParams()
	{
		Form::clear();

		$actual = (string) Form::label();
		$expected = '<label></label>';

		$this->assertEquals($expected, $actual);
	}

	public function testBuildsExpectedHtmlChainedMethods()
	{
		Form::clear();

		$actual = (string) Form::label()->label('My Label')->for('control_id');
		$expected = '<label for="control_id">My Label</label>';

		$this->assertEquals($expected, $actual);
	}

	public function testBuildsExpectedHtmlWithExtraAttributes()
	{
		Form::clear();

		$actual = (string) Form::label('My Label', 'control_id')->id('my_label_id')->class('control-label');
		$expected = '<label for="control_id" id="my_label_id" class="control-label">My Label</label>';

		$this->assertEquals($expected, $actual);
	}
}
