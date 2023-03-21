<?php

use Salahhusa9\Menu\Facades\Menu;

it('Test Store Menu', function () {
    Menu::add('test')
        ->add('test2')
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4');
        })
        ->add('test5');

    // test
    $menu = Menu::getMenu();
    expect($menu)->toBeArray();
    expect($menu)->toHaveCount(4);
    expect($menu[0]->name)->toBe('test');
    expect($menu[0]->submenu)->toBeArray();
    expect($menu[0]->submenu)->toHaveCount(0);
    expect($menu[1]->name)->toBe('test2');
    expect($menu[1]->submenu)->toBeArray();
    expect($menu[1]->submenu)->toHaveCount(0);
    expect($menu[2]->name)->toBe('test3');
    expect($menu[2]->submenu)->toBeArray();
    expect($menu[2]->submenu)->toHaveCount(1);
    expect($menu[2]->submenu[0]->name)->toBe('test4');
    expect($menu[3]->name)->toBe('test5');
    expect($menu[3]->submenu)->toBeArray();
    expect($menu[3]->submenu)->toHaveCount(0);
});
