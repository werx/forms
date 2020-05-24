<?php
namespace werxFormsTests;

use werx\Forms\Form;

class InputBuilderTextTests extends \PHPUnit_Framework_TestCase
{
	public function testTextBuildsExpectedHtml()
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

	public function testTextCanSetRequired()
	{
		Form::clear();

		$actual = (string) Form::text('test')->required();
		$expected = '<input name="test" id="test" type="text" required="required" />';
		$this->assertEquals($expected, $actual);
	}

	public function testTextCanSetDataExplicit()
	{
		Form::clear();

		Form::setData(['test' => 'werx']);

		$actual = (string) Form::text('test')->getValue();
		$expected = '<input name="test" id="test" type="text" value="werx" />';
		$this->assertEquals($expected, $actual);
	}

	public function testTextCanSetDataImplicit()
	{
		Form::clear();

		Form::setData(['test' => 'werx']);

		$actual = (string) Form::text('test');
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

	public function testTextSetPlaceholder()
	{
		Form::clear();

		$actual = (string) Form::text('test')->placeholder('werx');
		$expected = '<input name="test" id="test" type="text" placeholder="werx" />';
		$this->assertEquals($expected, $actual);
	}

	public function testHiddenBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::hidden('test');
		$expected = '<input name="test" id="test" type="hidden" />';

		$this->assertEquals($expected, $actual);
	}

	public function testPasswordBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::password('test');
		$expected = '<input name="test" id="test" type="password" />';

		$this->assertEquals($expected, $actual);
	}

	public function testEmailBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::email('test');
		$expected = '<input name="test" id="test" type="email" />';

		$this->assertEquals($expected, $actual);
	}

	public function testUrlBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::url('test');
		$expected = '<input name="test" id="test" type="url" />';

		$this->assertEquals($expected, $actual);
	}

	public function testTelBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::tel('test');
		$expected = '<input name="test" id="test" type="tel" />';

		$this->assertEquals($expected, $actual);
	}

	public function testTextAreaBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::textarea('test');
		$expected = '<textarea name="test" id="test"></textarea>';

		$this->assertEquals($expected, $actual);
	}

	public function testTextAreaBuildsExpectedHtmlWithValue()
	{
		Form::clear();

		$actual = (string) Form::textarea('test')->value('Foo');
		$expected = '<textarea name="test" id="test">Foo</textarea>';

		$this->assertEquals($expected, $actual);
	}

	public function testTextAreaBuildsExpectedHtmlFromSetData()
	{
		Form::clear();

		Form::setData(['test' => 'Foo']);

		$actual = (string) Form::textarea('test');
		$expected = '<textarea name="test" id="test">Foo</textarea>';

		$this->assertEquals($expected, $actual);
	}
}
