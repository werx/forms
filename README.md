# werx\Forms

[![Build Status](https://img.shields.io/travis/werx/forms.svg?style=flat-square)](https://travis-ci.org/werx/forms) [![Total Downloads](https://img.shields.io/packagist/dt/werx/forms.svg?style=flat-square)](https://packagist.org/packages/werx/forms) [![Latest Stable Version](https://img.shields.io/github/tag/werx/forms.svg?label=version&style=flat-square)](https://packagist.org/packages/werx/forms) [![Code Climate](https://img.shields.io/codeclimate/github/werx/forms.svg?style=flat-square)](https://codeclimate.com/github/werx/forms/code)

Framework agnostic form helpers.

## About
I've never found form libraries terribly useful. In my experience, they either work only for the most simple forms, or end up being way more difficult to use than just writing the HTML by hand.

That said, I do need some really basic form helpers to easily pre-populate form fields (like from previous POST to correct errors or from a database) and build drop down boxes.

The primary goal of this library is to solve those 2 problems in a way I don't hate. If I can make some more robust form helpers that don't get in my way while I'm at it, all the better.

This library provides helpers for setting default values in otherwise static html form elements as well as an input builder for dynamically creating form elements.

## Quick Examples

You can view the full documentation with more examples at <http://werx.moody.io/packages/forms/>

Here's a few quick examples to get you started.

```
<?php
use werx\Forms\Form;

Form::setData($_POST);
?>
```

### Text boxes
``` php
<input type="text" name="username" id="username" value="<?=Form::getValue('username')?>">
```

``` php
<?=Form::text('username')?>
```

### Selects

``` php
<select name="state">
	<option value="AR" <?=Form::getSelected('state', 'AR')?>>Arkansas</option>
	<option value="TX" <?=Form::getSelected('state', 'TX')?>>Texas</option>
	<option value="OK" <?=Form::getSelected('state', 'OK')?>>Oklahoma</option>
</select>
```

``` php
<?=Form::select('state')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma'])->label('Choose')?>
```

```php
<?=Form::select('color')->data(['Red', 'White', 'Blue'], true)->selected('White')?>
```

### Checkboxes and Radios

``` php
<input type="checkbox" name="pets" value="Cat" <?=Form::getChecked('pets', 'Cat')?> /> Cat
<input type="checkbox" name="pets" value="Dog" <?=Form::getChecked('pets', 'Dog')?> /> Dog
<input type="checkbox" name="pets" value="Fish" <?=Form::getChecked('pets', 'Fish')?> /> Fish
```

``` php
<input type="radio" name="color" value="Red" <?=Form::getChecked('color', 'Red')?> /> Red
<input type="radio" name="color" value="Blue" <?=Form::getChecked('color', 'Blue')?> /> Blue
<input type="radio" name="color" value="Green" <?=Form::getChecked('color', 'Green')?> /> Green
```

``` php
<?=Form::checkbox('pets')->value('Cat')?> Cat
<?=Form::checkbox('pets')->value('Dog')->checked()?> Dog
<?=Form::checkbox('pets')->value('Fish')?> Fish
```

``` php
<?=Form::radio('color')->value('Red')?> Red
<?=Form::radio('color')->value('Blue')->checked()?> Blue
<?=Form::radio('color')->value('Green')?> Green
```

Use the `checkedWhen()` method if you want to check something pending some condition. Pass any condition you like. If it evaluates to true, it will call `checked()` on the element.

``` php
<?=Form::radio('color')->value('Red')->checkedWhen($some_value == 'Red')?> Red
<?=Form::radio('color')->value('Blue')->checkedWhen($some_value == 'Blue')?> Blue
<?=Form::radio('color')->value('Green')->checkedWhen($some_value == 'Green')?> Green
```
> `checkedWhen()` works for both radios and checkboxes.

## Installation
This package is installable and autoloadable via Composer as [werx/forms](https://packagist.org/packages/werx/forms). If you aren't familiar with the Composer Dependency Manager for PHP, [you should read this first](https://getcomposer.org/doc/00-intro.md).

```bash
$ composer require werx/forms --prefer-dist
```


## Contributing

### Unit Testing

	$ composer test

### Coding Standards
This library uses [PHP_CodeSniffer](http://www.squizlabs.com/php-codesniffer) to ensure coding standards are followed.

I have adopted the [PHP FIG PSR-2 Coding Standard](http://www.php-fig.org/psr/psr-2/) EXCEPT for the tabs vs spaces for indentation rule. PSR-2 says 4 spaces. I use tabs. No discussion.

To support indenting with tabs, I've defined a custom PSR-2 ruleset that extends the standard [PSR-2 ruleset used by PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/blob/master/CodeSniffer/Standards/PSR2/ruleset.xml). You can find this ruleset in the root of this project at PSR2Tabs.xml

Execute the codesniffer command from the root of this project to run the sniffer using these custom rules and codefixer command to correct them.


	$ composer codesniffer
	$ composer codefixer
