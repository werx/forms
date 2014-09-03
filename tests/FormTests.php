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
}
