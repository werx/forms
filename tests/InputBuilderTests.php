<?php
namespace werx\Forms\Tests;

use werx\Forms\Form;

class InputBuilderTests extends \PHPUnit_Framework_TestCase
{

	public function testTextBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::text('test');
		$expected = '<input name="test" id="test" type="text" />';
		$this->assertEquals($expected, $actual);
	}

	public function testTextSetValue()
	{
		Form::clear();

		$actual = (string) Form::text('test')->value('werx');
		$expected = '<input name="test" id="test" type="text" value="werx" />';
		$this->assertEquals($expected, $actual);
	}

	public function testTextCanSetData()
	{
		Form::clear();

		Form::setData(['test' => 'werx']);

		$actual = (string) Form::text('test')->getValue();
		$expected = '<input name="test" id="test" type="text" value="werx" />';
		$this->assertEquals($expected, $actual);
	}

	public function testTextCanSetDataWithDefaultOnMissingValue()
	{
		Form::clear();

		$actual = (string) Form::text('test')->getValue('not set');
		$expected = '<input name="test" id="test" type="text" value="not set" />';
		$this->assertEquals($expected, $actual);
	}

	public function testSelectBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::select('test')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="test" id="test"><option value="TX">Texas</option><option value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectBuildsCorrectHtmlWithLabel()
	{
		Form::clear();

		$actual = (string) Form::select('test')->data(['' => 'Choose', 'TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="test" id="test"><option selected="selected" value="">Choose</option><option value="TX">Texas</option><option value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectCanSetSelectedWithValue()
	{
		Form::clear();

		$actual = (string) Form::select('test')->selected('AR')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="test" id="test"><option value="TX">Texas</option><option selected="selected" value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectCanSetSelectedWithGetValue()
	{
		Form::clear();

		Form::setData(['test' => 'AR']);
		$actual = (string) Form::select('test')->getValue()->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="test" id="test"><option value="TX">Texas</option><option selected="selected" value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testSelectCanSetSelectedWithGetValueOnMissingValue()
	{
		Form::clear();

		$actual = (string) Form::select('test')->getValue('AR')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="test" id="test"><option value="TX">Texas</option><option selected="selected" value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

		$this->assertEquals($expected, $actual);
	}

	public function testCheckboxBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::checkbox('test');
		$expected = '<input type="checkbox" name="test" id="test" />';

		$this->assertEquals($expected, $actual);
	}

	public function testRadioBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::radio('test');
		$expected = '<input type="radio" name="test" id="test" />';

		$this->assertEquals($expected, $actual);
	}

	public function testHiddenBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::hidden('test');
		$expected = '<input name="test" id="test" type="hidden" />';

		$this->assertEquals($expected, $actual);
	}

	public function testPasswordBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::password('test');
		$expected = '<input name="test" id="test" type="password" />';

		$this->assertEquals($expected, $actual);
	}

	public function testEmailBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::email('test');
		$expected = '<input name="test" id="test" type="email" />';

		$this->assertEquals($expected, $actual);
	}

	public function testUrlBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::url('test');
		$expected = '<input name="test" id="test" type="url" />';

		$this->assertEquals($expected, $actual);
	}

	public function testTelBuildsCorrectHtml()
	{
		Form::clear();

		$actual = (string) Form::tel('test');
		$expected = '<input name="test" id="test" type="tel" />';

		$this->assertEquals($expected, $actual);
	}
}
