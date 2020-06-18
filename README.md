![Test PHP](https://github.com/SebKay/oop-wp/workflows/Test%20PHP/badge.svg)

# OOP WP
A simple library of OOP style helpers for WordPress theme and plugin development.

It gives you well-formatted classes for things like posts for accessing items such as the title or publish date. It can easily be extended into sub-classes in your own projects.

Most of the methods are wrappers for already existing functions like `get_the_title()`

## How to install
It's recommended you install this package via [Composer](https://getcomposer.org/).

```bash
composer require sebkay/oop-wp
```

You'll then need to include the Composer autoloader so you have access to the package. Add the following at the top of your `functions.php` file:

```php
require get_template_directory() . '/vendor/autoload.php';
```

## How to use
Wherever you want to use one of the OOP implementations, you can do like this:

```php
$blog_post = new OOPWP\Posts\Post(get_the_ID());

$blog_post->title();
```

## Available Methods
### OOPWP\Posts\Post
<table>
  <tr>
    <th>
      Methods
    </th>
    <th></th>
  </tr>
  <tr>
    <td><code>->id()</code></td>
    <td>Outputs whatever ID is passed to the constructor.</td>
  </tr>
  <tr>
    <td><code>->url()</code></td>
    <td>Wrapper for <code>get_permalink()</code>.</td>
  </tr>
  <tr>
    <td><code>->slug()</code></td>
    <td>Returns <code>->post_name</code> from the <code>WP_Post</code> object.</td>
  </tr>
  <tr>
    <td><code>->status()</code></td>
    <td>Wrapper for <code>get_post_status()</code>.</td>
  </tr>
  <tr>
    <td><code>->format()</code></td>
    <td>Wrapper for <code>get_post_format()</code>.</td>
  </tr>
  <tr>
    <td><code>->title()</code></td>
    <td>Wrapper for <code>get_the_title()</code>.</td>
  </tr>
  <tr>
    <td><code>->excerpt()</code></td>
    <td>Wrapper for <code>get_the_excerpt()</code>.</td>
  </tr>
  <tr>
    <td><code>->publishDate()</code></td>
    <td>Wrapper for <code>get_the_date()</code>.</td>
  </tr>
  <tr>
    <td><code>->modifiedDate()</code></td>
    <td>Wrapper for <code>get_the_modified_time()</code>.</td>
  </tr>
  <tr>
    <td><code>->content()</code></td>
    <td>Returns <code>->post_content</code> from the <code>WP_Post</code> object and applies <code>the_content</code> filter.</td>
  </tr>
  <tr>
    <td><code>->parent()</code></td>
    <td>Returns a new <code>Post</code> object using <code>->post_parent</code> from the <code>WP_Post</code> object.</td>
  </tr>
</table>

### OOPWP\User
<table>
  <tr>
    <th>
      Methods
    </th>
    <th></th>
  </tr>
  <tr>
    <td><code>->id()</code></td>
    <td>Outputs whatever ID is passed to the constructor.</td>
  </tr>
  <tr>
    <td><code>->meta()</code></td>
    <td>Get custom meta field.</td>
  </tr>
  <tr>
    <td><code>->firstName()</code></td>
    <td>First name meta field.</td>
  </tr>
  <tr>
    <td><code>->lastName()</code></td>
    <td>Last name meta field.</td>
  </tr>
  <tr>
    <td><code>->fullName()</code></td>
    <td>Combination of <code>->firstName()</code> and <code>->lastName()</code>.</td>
  </tr>
  <tr>
    <td><code>->nickname()</code></td>
    <td>Nickname meta field.</td>
  </tr>
  <tr>
    <td><code>->description()</code></td>
    <td>Biographical info meta field with <code>the_content</code> filter applied.</td>
  </tr>
  <tr>
    <td><code>->username()</code></td>
    <td><code>user_login</code> field from <code>WP_User</code> object.</td>
  </tr>
  <tr>
    <td><code>->nicename()</code></td>
    <td>A URL friendly version of <code>->username()</code>.<br><code>user_nicename</code> property from <code>WP_User->data</code> object.</td>
  </tr>
  <tr>
    <td><code>->displayName()</code></td>
    <td><code>display_name</code> property from <code>WP_User->data</code> object.</td>
  </tr>
  <tr>
    <td><code>->email()</code></td>
    <td><code>user_email</code> property from <code>WP_User->data</code> object.</td>
  </tr>
  <tr>
    <td><code>->url()</code></td>
    <td><code>user_url</code> property from <code>WP_User->data</code> object.</td>
  </tr>
  <tr>
    <td><code>->registredDate()</code></td>
    <td><code>user_registered</code> property from <code>WP_User->data</code> object.</td>
  </tr>
</table>
