# OOP WP

[![Test PHP](https://github.com/SebKay/oop-wp/actions/workflows/php.yml/badge.svg)](https://github.com/SebKay/oop-wp/actions/workflows/php.yml)

A simple library of OOP style helper classes for WordPress theme and plugin development.

Most methods in this package are wrappers for already existing functionality like `get_the_title()` or `get_user_meta()`, but they give you a much cleaner (and more modern) way to do so!

## Installation

It's recommended you install this package via [Composer](https://getcomposer.org/).

```bash
composer require sebkay/oop-wp
```

You'll need to include the Composer autoloader so you have access to the package. Add the following to the top of your `functions.php` file:

```php
require get_template_directory() . '/vendor/autoload.php';
```

## Usage

Wherever you want to use one of the OOP implementations, you can do so like this:

```php
use OOPWP\PostTypes\Post;

$blog_post = new Post(get_the_ID());

$blog_post->title();
```

### Dates with `nesbot/carbon`

All dates use the [Carbon](https://github.com/briannesbitt/Carbon) PHP library.

```php
use OOPWP\PostTypes\Post;

$blog_post = new Post(get_the_ID());

# date() is \Carbon\Carbon object
$blog_post->date()->format('j F Y);
```

## Available Classes

### Posts

- `OOPWP\PostTypes\Post`

### Users

- `OOPWP\Users`
