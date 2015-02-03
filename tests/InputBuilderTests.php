<?php
namespace werx\Forms\Tests;

use werx\Forms\Form;

class InputBuilderTests extends \PHPUnit_Framework_TestCase
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

	public function testSelectBuildsExpectedHtml()
	{
		Form::clear();

		$actual = (string) Form::select('state')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma']);
		$expected = '<select name="state" id="state"><option value="TX">Texas</option><option value="AR">Arkansas</option><option value="OK">Oklahoma</option></select>';

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
