<?php
namespace werx\Forms\Tests;

use werx\Forms\Form;

class InputBuilderSelectTests extends \PHPUnit_Framework_TestCase
{
	public function testSelectBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::select('state')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="state" id="state"><option value="TX">Texas</option><option value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectWithNoDataBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::select('state');
		$expected = '<select name="state" id="state"></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectCanSetArrayValuesAsOptionValues()
	{
		Form::clear();

		$actual = (string) Form::select('color')->data(['Red', 'White', 'Blue'], true)->selected('White');
		$expected = '<select name="color" id="color"><option value="Red">Red</option><option selected="selected" value="White">White</option><option value="Blue">Blue</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectBuildsExpectedHtmlWithLabel()
	{
		Form::clear();

		$actual = (string) Form::select('state')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma'])->label('Choose');
		$expected = '<select name="state" id="state"><option value="">Choose</option><option value="TX">Texas</option><option value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectBuildsExpectedHtmlWithLabelValue()
	{
		Form::clear();

		$actual = (string) Form::select('state')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma'])->label('Choose', 'xx');
		$expected = '<select name="state" id="state"><option value="xx">Choose</option><option value="TX">Texas</option><option value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectCanSetSelectedWithValue()
	{
		Form::clear();

		$actual = (string) Form::select('state')->selected('AR')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="state" id="state"><option value="TX">Texas</option><option selected="selected" value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectCanSetSelectedFromFormDataExplicit()
	{
		Form::clear();

		Form::setData(['state' => 'AR']);
		$actual = (string) Form::select('state')->getValue()->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="state" id="state"><option value="TX">Texas</option><option selected="selected" value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';
		$this->assertEquals($expected, $actual);
	}

	public function testSelectCanSetSelectedFromFormDataImplicit()
	{
		Form::clear();

		Form::setData(['state' => 'AR']);
		$actual = (string) Form::select('state')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="state" id="state"><option value="TX">Texas</option><option selected="selected" value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';
		$this->assertEquals($expected, $actual);
	}

	public function testSelectCanSetSelectedWithGetValueOnMissingValue()
	{
		Form::clear();

		$actual = (string) Form::select('test')->getValue('AR')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="test" id="test"><option value="TX">Texas</option><option selected="selected" value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectStateBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::selectState('state');

		$this->assertContains('<option value="AR">Arkansas</option>', $actual);
	}

	public function testSelectStateBuildsExpectedHtmlWithValue()
	{
		Form::clear();

		$actual = (string) Form::selectState('state')->selected('AR');

		$this->assertContains('<option selected="selected" value="AR">Arkansas</option>', $actual);
	}

	public function testSelectStateBuildsExpectedHtmlWithLabel()
	{
		Form::clear();

		$actual = (string) Form::selectState('state')->label('Choose State');

		$this->assertContains('<option value="AR">Arkansas</option>', $actual);
		$this->assertContains('<option value="">Choose State</option>', $actual);
	}

	public function testSelectStateCanUseDisplayNameForValue()
	{
		Form::clear();

		$actual = (string) Form::selectState('state')->selected('Arkansas')->useDisplayNameForValue(true);

		$this->assertContains('<option selected="selected" value="Arkansas">Arkansas</option>', $actual);
	}

	public function testSelectCountyBuildsExpectedHtmlForDefaultState()
	{
		Form::clear();

		$actual = (string) Form::selectCounty('county');

		$this->assertContains('<option value="Pulaski">Pulaski</option>', $actual);
	}

	public function testSelectCountyBuildsExpectedHtmlWithValueForDefaultState()
	{
		Form::clear();

		$actual = (string) Form::selectCounty('county')->selected('Pulaski');

		$this->assertContains('<option selected="selected" value="Pulaski">Pulaski</option>', $actual);
	}

	public function testSelectCountyBuildsExpectedHtmlForState()
	{
		Form::clear();

		$actual = (string) Form::selectCounty('county')->forState('TX');

		$this->assertContains('<option value="Dallas">Dallas</option>', $actual);
	}

	public function testSelectCountyBuildsExpectedHtmlWithLabel()
	{
		Form::clear();

		$actual = (string) Form::selectCounty('county')->forState('AR')->label('Choose County');

		$this->assertContains('<option value="">Choose County</option>', $actual);
		$this->assertContains('<option value="Pulaski">Pulaski</option>', $actual);
	}
}
