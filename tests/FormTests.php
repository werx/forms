<?php
namespace werx\Forms\Tests;

use werx\Forms\Form;

class FormsTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetFormOpenTag()
	{
		Form::clear();

		$actual = Form::open();
		$expected = '<form >';

		$this->assertEquals($expected, $actual);
	}

	public function testCanGetFormOpenTagWithAttributes()
	{
		Form::clear();

		$actual = Form::open(['method' => 'POST', 'action' => 'home/submit']);
		$expected = '<form method="POST" action="home/submit">';

		$this->assertEquals($expected, $actual);
	}

	public function testCanCloseFormTag()
	{
		Form::clear();

		$actual = Form::close();
		$expected = '</form>';

		$this->assertEquals($expected, $actual);
	}

	public function testCanGetFormData()
	{
		Form::clear();

		Form::setData(['foo' => 'bar']);

		$data = Form::getData();

		$this->assertArrayHasKey('foo', $data);
		$this->assertEquals('bar', $data['foo']);
	}

	public function testGetValue()
	{
		Form::clear();

		Form::setData(['test' => 'werx']);

		$this->assertEquals('werx', Form::getValue('test'));
	}

	public function testGetValueNullDefault()
	{
		Form::clear();

		$this->assertEquals(null, Form::getValue('test'));
	}

	public function testGetValueCustomDefault()
	{
		Form::clear();

		$this->assertEquals('werx', Form::getValue('test', 'werx'));
	}

	public function testGetValueEscapesXss()
	{
		Form::clear();

		Form::setData(['test' => '<script>alert("xss")</script>']);
		$this->assertEquals('&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', Form::getValue('test'));
	}

	public function testGetValueSkipEscapesXss()
	{
		Form::clear();

		Form::setData(['test' => '<script>alert("xss")</script>']);
		$this->assertEquals('<script>alert("xss")</script>', Form::getValue('test', null, false));
	}

	public function testGetCheckedReturnsExpectedHtml()
	{
		Form::clear();

		Form::setData(['foo' => 'bar']);

		$actual = Form::getChecked('foo', 'bar');
		$expected = 'checked = "checked"';

		$this->assertEquals($expected, $actual);
	}

	public function testGetCheckedReturnsExpectedHtmlArray()
	{
		Form::clear();

		Form::setData(['fruits' => ['apples', 'oranges']]);

		$actual = Form::getChecked('fruits', 'apples');
		$expected = 'checked = "checked"';
		$this->assertEquals($expected, $actual);

		$actual = Form::getChecked('fruits', 'oranges');
		$expected = 'checked = "checked"';
		$this->assertEquals($expected, $actual);

		$actual = Form::getChecked('fruits', 'pears');
		$expected = null;
		$this->assertEquals($expected, $actual, 'Pears should not be checked.');
	}

	public function testGetSelectedReturnsExpectedHtml()
	{
		Form::clear();

		Form::setData(['foo' => 'bar']);

		$actual = Form::getSelected('foo', 'bar');
		$expected = 'selected = "selected"';

		$this->assertEquals($expected, $actual);
	}

	public function testGetSelectedReturnsExpectedHtmlArray()
	{
		Form::clear();

		Form::setData(['fruits' => ['apples', 'oranges']]);

		$actual = Form::getSelected('fruits', 'apples');
		$expected = 'selected = "selected"';
		$this->assertEquals($expected, $actual);

		$actual = Form::getSelected('fruits', 'oranges');
		$expected = 'selected = "selected"';
		$this->assertEquals($expected, $actual);

		$actual = Form::getSelected('fruits', 'pears');
		$expected = null;
		$this->assertEquals($expected, $actual, 'Pears should not be selected.');
	}
}
