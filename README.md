# Laravel Menu Generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/salahhusa9/laravel-menu.svg?style=flat-square)](https://packagist.org/packages/salahhusa9/laravel-menu)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/salahhusa9/laravel-menu/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/salahhusa9/laravel-menu/actions?query=workflow%3Arun-tests+branch%3Amain)
[![PHPStan Status](https://img.shields.io/github/actions/workflow/status/salahhusa9/laravel-menu/phpstan.yml?branch=main&label=PHPStan&style=flat-square)](https://github.com/salahhusa9/laravel-menu/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
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

You can create menu in your application in any place you want, but the best place is in the AppServiceProvider.php file in the boot() method.

```php
use SalahHusa9\Menu\Facades\Menu;

public function boot()
{
    Menu::add('test', 'route.name', 'fa fa-home');
}
```

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

### Blade

To render the menu, use the `<x-menu />` blade component.

```html
<x-menu />
```

### Customization of the menu

Icons can be added to the menu items by passing the icon parameter to the add() method.

```php
Menu::add('test', 'route.name', ['icon' => 'fa fa-home']);
```

You can also add a id and class to the menu item by passing the id and class parameters to the add() method.

```php
Menu::add('test', 'route.name',['class' => 'customClass', 'id' => 'customId']);
```

You can also add a target to the menu item by passing the target parameter to the add() method.

```php
Menu::add('test', 'route.name', ['target' => '_blank']);
```

You can also add a badge to the menu item by passing the badgeClass and badgeName parameters to the add() method.

```php
Menu::add('test', 'route.name', ['badgeClass' => 'badge badge-success', 'badgeName' => 'New']);
```

You can also

```php
// old:
if (auth()->user()->can('gateName')){
    Menu::add('test', 'route.name');
}
// new:
Menu::add('test', 'route.name', ['gateName' => 'gateName']);
```

### Customization of the menu view

You can customize the menu view by publishing the views using

```bash
php artisan vendor:publish --tag="menu-views"
```

### Multiple Menus

You can create multiple menus in your application:

```php
    Menu::make('sidebar', function ($menu) {
        $menu->add('test', 'route.name');
    });

    Menu::make('main', function ($menu) {
        $menu->add('test', 'route.name');
    });
```

For render the menu, use the `<x-menu for="sidebar" />` blade component.

## Configuration of the defult menu Classes of Ul and Li and the active class

You can publish the config file with:

```bash
php artisan vendor:publish --tag="menu-config"
```

and you can change the defult menu Classes of Ul and Li and the active class

```php
return [
    "ul_class" => "menu-inner py-1", // default menu class
    "ul_sub_menu_class" => "menu-sub", // default submenu class

    "li_class" => "menu-item", // default menu item class
    "li_sub_menu_class" => "menu-item", // default submenu item class
    "li_sub_menu_open_class" => "menu-item active open", // default submenu item class when open

    "a_class" => "menu-link", // default menu link class
    "a_sub_menu_class" => "menu-link menu-toggle", // default submenu link class

    "icon_class" => "menu-icon", // default menu icon class

    "li_active_class" => "active", // default active class of li
    "a_active_class" => "active", // default active class of a

    "badge_class" => "badge rounded-pill ms-auto", // default badge class
];
```

## Advanced

Each Item accept this parames :

```php
add(
    $name,
    $routeName = null,
    $options = [],
)

addSubmenu(
    $name,
    callback $callbackOfSubmenu,
    $options
)
```

There is other functions that you can used :

```php
Menu::getMenuAsJson(); // return the menu as json
Menu::renderAsJson(); // return the menu as json
Menu::renderAsHtml(); // return the menu as html
```

## Roadmap

See the [open issues](../../issues) for a list of proposed features (and known issues).

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

-   [salahhusa9](https://github.com/salahhusa9)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
