Generator
================================

## Quickstart

Checkout [sleeve.phar](https://github.com/CodeSleeve/sleeve.phar) to get started generating.

Or you can manually work with the `Console\Application`

```php
	$app = new Codesleeve\Generator\Console\Application('some name', '1.0.0')

	$app->setupGenerators(getcwd(), __DIR__);

	$app->run();
```

## How does it work?

This project creates a vanilla generator setup which can be configured for any type of boilerplate generation.

This is really to be used as a third-party library that mediates the workflow for any kind of custom generator templates. If you want to see it in action then check out our Laravel 4 generator [sleeve.phar](https://github.com/CodeSleeve/sleeve.phar).

Of course you don't have to use it with Laravel, it could be used to generate code for another framework or language, if that is your cup of tea.

*Here is the main idea.*

> If you combine **variables** + **templates** + **parser** then you have created a generator.

This flowchart might help with understanding how everything all comes together.

![Flowchart Diagram For How Generator Works](http://i62.tinypic.com/3463hw2.png "Generator Flowchart")

## License

The codesleeve generator is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## Tests

If you want to see some pretty tests, then run tests run

```php
	vendor/bin/phpspec run
```
