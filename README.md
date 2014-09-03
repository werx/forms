# werx\Forms

[![Build Status](https://travis-ci.org/werx/forms.png?branch=master)](https://travis-ci.org/werx/forms) [![Total Downloads](https://poser.pugx.org/werx/forms/downloads.png)](https://packagist.org/packages/werx/forms) [![Latest Stable Version](https://poser.pugx.org/werx/forms/v/stable.png)](https://packagist.org/packages/werx/forms)

Framework agnostic form helpers.

## About
I've never found form libraries terribly useful. In my experience, they either work only for the most simple forms, or end up being way more difficult to use than just writing the HTML by hand.

That said, I do need some really basic form helpers to easily pre-populate form fields (like from previous POST to correct errors or from a database) and build drop down boxes.

The primary goal of this library is to solve those 2 problems in a way I don't hate. If I can make some more robust form helpers that don't get in my way while I'm at it, all the better.

## Form Basics

Open a form:

``` php
<?=Form::open(['method' => 'POST', 'action' => 'home/submit'])?>
```

Close a form:
``` php
<?=Form::close()?>
```

## Text Input

We'll begin by telling the form about any data we want to be available in the form. In this example, we are using data from the previous form submission.

```php
Form::setData($_POST);
```

Now, we'll write the HTML for a input box and dynamically pre-populate it with the value from `$_POST`.

``` php
<input type="text" name="username" id="username" value="<?=Form::getValue('username')?>">
```

We can also pre-populate with a default value if the data didn't exist in `$_POST`. It defaults to null, but you can override this with a 2nd parameter to `Form::getValue()`.

``` php
<input type="text" name="username" id="username" value="<?=Form::getValue('username', 'josh')?>">
```
> There is also a third parameter to `Form::getValue()` that controls whether or not to escape the value. Default: true


Do you prefer to build your element entirely in PHP? Use the builder.

Build a text box named "username".
``` php
<?=Form::text('username')?>
```

You can also pre-populate it from the previous form submission with `Form::setData()`.
``` php
<?=Form::text('username')->getValue()?>
```

Ore pre-populate it from the previous form submission with `Form::setData()` with a default if there was no previous submission.
``` php
<?=Form::text('username')->getValue('josh')?>
```

Or just manually set the value without worrying about a previous submission.
``` php
<?=Form::text('username')->value('Josh')?>
```

Other input types are also supported and work identically to `Form::text()`.

- Form::hidden();
- Form::password();
- Form::email();
- Form::url();
- Form::tel();

### Dropdown Boxes

You can hand write your HTML with dynamically selected option from `Form::setData()`.

``` php
<select name="state">
	<option <?=Form::selected('state', 'AR')?>>AR</option>
	<option <?=Form::selected('state', 'TX')?>>TX</option>
	<option <?=Form::selected('state', 'OK')?>>OK</option>
</select>
```

Or use the builder with a dynamically selected options from `Form::setData()`.

``` php
<?=Form::select('state')->getValue()->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma'])?>
```

Or you can use the builder with manually selected option.

``` php
<?=Form::select('state')->selected('AR')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma'])?>
```

Or use the builder with dynamically selected option and default override if the value wasn't set in `Form::setData()`.

``` php
<?=Form::select('state')->getValue('AR')->data(['TX' => 'Texas', 'AR' => 'Arkansas', 'OK' => 'Oklahoma'])?>
```

### Checkboxes and Radios

Like the other inputs, you can use Hand-crafted HTML with a helper to automatically check items or use the builder.

#### Checkboxes
``` php
<?php
Form::setData(['pets' => ['Dog', 'Fish']]);
```

``` php
<input type="checkbox" name="pets" value="Cat" <?=Form::checked('pets', 'Cat')?> /> Cat
<input type="checkbox" name="pets" value="Dog" <?=Form::checked('pets', 'Dog')?> /> Dog
<input type="checkbox" name="pets" value="Fish" <?=Form::checked('pets', 'Fish')?> /> Fish
```

``` php
<?=Form::checkbox('pets')->value('Cat')?> Cat
<?=Form::checkbox('pets')->value('Dog')?> Dog
<?=Form::checkbox('pets')->value('Fish')?> Fish
```
> In the previous 2 examples, Dog and Fish were automatically checked because of the value from `Form::setData()`.

``` php
<?=Form::checkbox('colors')->value('Red')?> Red
<?=Form::checkbox('colors')->value('Blue')->checked()?> Blue
<?=Form::checkbox('colors')->value('Green')?> Green
```
> In this example, we manually forced 'Blue' to be checked.

### Buttons

``` php
<?=Form::button('reset')->type("reset")->value('submit')->label('Submit')?>
<?=Form::submit('submit')->value('Submit!')?>
```


### Extended Attributes
For more complex elements, you can chain methods together to create any html attribute you want. Just call the method that corresponds to the attribute name you want, passing in the attribute value.

``` php
<?=Form::text('name')->getValue()->class('form-control')->style('width: 250px')?>
```

``` php
<?=Form::submit('submit')->class('btn btn-primary')->value('Submit')?>
```
Renders as:

``` html
<input type="text" name="username" id="username" value="josh" class="form-control" style="width:250px" required="required"/>
```


## Installation
This library is on Packagist at [werx/forms](https://packagist.org/packages/werx/forms). It can be installed and auto loaded with [composer](https://getcomposer.org).

Example composer.json

``` javascript
{
	"require": {
		"werx/forms": "dev-master"
	}
}
```

Don't forget to include Composer's auto loader.

``` php
<?php
require 'vendor/autoload.php';
```

## Contributing

### Unit Testing

	$ vendor/bin/phpunit

### Coding Standards
This library uses [PHP_CodeSniffer](http://www.squizlabs.com/php-codesniffer) to ensure coding standards are followed.

I have adopted the [PHP FIG PSR-2 Coding Standard](http://www.php-fig.org/psr/psr-2/) EXCEPT for the tabs vs spaces for indentation rule. PSR-2 says 4 spaces. I use tabs. No discussion.

To support indenting with tabs, I've defined a custom PSR-2 ruleset that extends the standard [PSR-2 ruleset used by PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/blob/master/CodeSniffer/Standards/PSR2/ruleset.xml). You can find this ruleset in the root of this project at PSR2Tabs.xml

Executing the codesniffer command from the root of this project to run the sniffer using these custom rules.


	$ ./codesniffer
