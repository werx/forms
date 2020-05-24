<?php
namespace werxFormsTests;

use werx\Forms\Form;

class InputBuilderCheckboxRadioTests extends \PHPUnit_Framework_TestCase
{

	public function testCheckboxBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::checkbox('test');
		$expected = '<input type="checkbox" name="test" id="test" />';

		$this->assertEquals($expected, $actual);
	}

	public function testCheckBoxCanCheckSelected()
	{
		Form::clear();

		Form::setData(['pets' => ['Cat', 'Fish']]);

		$actual = (string) Form::checkbox('pets')->value('Cat');
		$expected = '<input type="checkbox" name="pets" id="pets" value="Cat" checked="checked" />';
		$this->assertEquals($expected, $actual);

		$actual = (string) Form::checkbox('pets')->value('Fish');
		$expected = '<input type="checkbox" name="pets" id="pets" value="Fish" checked="checked" />';
		$this->assertEquals($expected, $actual);

		$actual = (string) Form::checkbox('pets')->value('Dog');
		$expected = '<input type="checkbox" name="pets" id="pets" value="Dog" />';
		$this->assertEquals($expected, $actual);
	}

	public function testCheckBoxCanManuallySetSelected()
	{
		Form::clear();

		$actual = (string) Form::checkbox('pets')->value('Cat')->checked();
		$expected = '<input type="checkbox" name="pets" id="pets" value="Cat" checked="checked" />';

		$this->assertEquals($expected, $actual);
	}

	public function testCheckBoxCanConditionallySetSelectedMatching()
	{
		Form::clear();

		$actual = (string) Form::checkbox('pets')->value('Cat')->conditionalChecked('foo', 'foo');
		$expected = '<input type="checkbox" name="pets" id="pets" value="Cat" checked="checked" />';

		$this->assertEquals($expected, $actual);
	}

	public function testCheckBoxCanConditionallySetSelectedNonMatching()
	{
		Form::clear();

		$actual = (string) Form::checkbox('pets')->value('Cat')->conditionalChecked('foo', 'bar');
		$expected = '<input type="checkbox" name="pets" id="pets" value="Cat" />';

		$this->assertEquals($expected, $actual);
	}

	public function testCheckBoxConditionalSetJunkArgs()
	{
		Form::clear();

		$actual = (string) Form::checkbox('pets')->value('Cat')->conditionalChecked('foo');
		$expected = '<input type="checkbox" name="pets" id="pets" value="Cat" />';

		$this->assertEquals($expected, $actual);

		Form::clear();

		$actual = (string) Form::radio('pets')->value('Cat')->conditionalChecked();
		$expected = '<input type="radio" name="pets" id="pets" value="Cat" />';

		$this->assertEquals($expected, $actual);
	}

	public function testCheckedWhenFalseConditionShouldNotCheckItem()
	{
		Form::clear();

		$actual = (string) Form::checkbox('pets')->value('Cat')->checkedWhen(false);
		$expected = '<input type="checkbox" name="pets" id="pets" value="Cat" />';

		$this->assertEquals($expected, $actual);

		Form::clear();

		$actual = (string) Form::radio('pets')->value('Cat')->checkedWhen(false);
		$expected = '<input type="radio" name="pets" id="pets" value="Cat" />';

		$this->assertEquals($expected, $actual);
	}

	public function testCheckedWhenTrueConditionShouldCheckItem()
	{
		Form::clear();

		$actual = (string) Form::checkbox('pets')->value('Cat')->checkedWhen(true);
		$expected = '<input type="checkbox" name="pets" id="pets" value="Cat" checked="checked" />';

		$this->assertEquals($expected, $actual);

		Form::clear();

		$actual = (string) Form::radio('pets')->value('Cat')->checkedWhen(true);
		$expected = '<input type="radio" name="pets" id="pets" value="Cat" checked="checked" />';

		$this->assertEquals($expected, $actual);
	}

	public function testRadioBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::radio('test');
		$expected = '<input type="radio" name="test" id="test" />';

		$this->assertEquals($expected, $actual);
	}

	public function testRadioCanCheckSelected()
	{
		Form::clear();

		Form::setData(['pet' => 'Cat']);

		$actual = (string) Form::radio('pet')->value('Cat');
		$expected = '<input type="radio" name="pet" id="pet" value="Cat" checked="checked" />';
		$this->assertEquals($expected, $actual);

		$actual = (string) Form::radio('pet')->value('Fish');
		$expected = '<input type="radio" name="pet" id="pet" value="Fish" />';
		$this->assertEquals($expected, $actual);

		$actual = (string) Form::radio('pet')->value('Dog');
		$expected = '<input type="radio" name="pet" id="pet" value="Dog" />';
		$this->assertEquals($expected, $actual);
	}

	public function testRadioCanManuallySetSelected()
	{
		Form::clear();

		$actual = (string) Form::radio('pet')->value('Cat')->checked();
		$expected = '<input type="radio" name="pet" id="pet" value="Cat" checked="checked" />';

		$this->assertEquals($expected, $actual);
	}

	public function testRadioCanConditionallySetSelectedMatching()
	{
		Form::clear();

		$actual = (string) Form::radio('pets')->value('Cat')->conditionalChecked('foo', 'foo');
		$expected = '<input type="radio" name="pets" id="pets" value="Cat" checked="checked" />';

		$this->assertEquals($expected, $actual);
	}

	public function testRadioCanConditionallySetSelectedNonMatching()
	{
		Form::clear();

		$actual = (string) Form::radio('pets')->value('Cat')->conditionalChecked('foo', 'bar');
		$expected = '<input type="radio" name="pets" id="pets" value="Cat" />';

		$this->assertEquals($expected, $actual);
	}

	public function testRadioConditionalSetJunkArgs()
	{
		Form::clear();

		$actual = (string) Form::radio('pets')->value('Cat')->conditionalChecked('foo');
		$expected = '<input type="radio" name="pets" id="pets" value="Cat" />';

		$this->assertEquals($expected, $actual);

		Form::clear();

		$actual = (string) Form::radio('pets')->value('Cat')->conditionalChecked();
		$expected = '<input type="radio" name="pets" id="pets" value="Cat" />';

		$this->assertEquals($expected, $actual);
	}
}
