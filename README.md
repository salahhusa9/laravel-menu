# Html menu generator for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/salahhusa9/laravel-menu.svg?style=flat-square)](https://packagist.org/packages/salahhusa9/laravel-menu)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/salahhusa9/laravel-menu/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/salahhusa9/laravel-menu/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/salahhusa9/laravel-menu/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/salahhusa9/laravel-menu/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/salahhusa9/laravel-menu.svg?style=flat-square)](https://packagist.org/packages/salahhusa9/laravel-menu)

This is a useful package for building menus in your Laravel application, and it can help simplify the process of creating and managing menus in your application.

## Installation

You can install the package via composer:

```bash
composer require salahhusa9/laravel-menu
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="menu-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="menu-views"
```

## Usage
### Basic
Add items to the menu using the add() method. You can chain multiple add() calls to add multiple items.
```php
Menu::add('test')
    ->add('test2');
```
To create a submenu, call addSubmenu() on a menu item and add items to the submenu using the add() method.
```php
Menu::add('test')
        ->add('test2')
        ->addSubmenu('test3', function ($submenu) {
            $submenu->add('test4');
        })
        ->add('test5');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [salahhusa9](https://github.com/salahhusa9)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
