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

it('Test Store Menu with custom class', function () {
    Menu::add('test', null, null, 'custom-class')
        ->add('test2', null, null, 'custom-class')
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, null, 'custom-class');
        }, null, 'custom-class')
        ->add('test5', null, null, 'custom-class');

    // test
    $menu = Menu::getMenu();
    expect($menu)->toBeArray();
    expect($menu)->toHaveCount(4);
    expect($menu[0]->name)->toBe('test');
    expect($menu[0]->class)->toBe('custom-class');
    expect($menu[0]->submenu)->toBeArray();
    expect($menu[0]->submenu)->toHaveCount(0);
    expect($menu[1]->name)->toBe('test2');
    expect($menu[1]->class)->toBe('custom-class');
    expect($menu[1]->submenu)->toBeArray();
    expect($menu[1]->submenu)->toHaveCount(0);
    expect($menu[2]->name)->toBe('test3');
    expect($menu[2]->class)->toBe('custom-class');
    expect($menu[2]->submenu)->toBeArray();
    expect($menu[2]->submenu)->toHaveCount(1);
    expect($menu[2]->submenu[0]->name)->toBe('test4');
    expect($menu[2]->submenu[0]->class)->toBe('custom-class');
    expect($menu[3]->name)->toBe('test5');
    expect($menu[3]->class)->toBe('custom-class');
    expect($menu[3]->submenu)->toBeArray();
    expect($menu[3]->submenu)->toHaveCount(0);
});

it('render view', function () {
    Menu::add('test')
        ->add('test2')
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4');
        })
        ->add('test5');

    $view = Menu::render();
    expect($view)->toBeString();
    expect($view)->toContain('test');
    expect($view)->toContain('test2');
    expect($view)->toContain('test3');
    expect($view)->toContain('test4');
    expect($view)->toContain('test5');
});

it('render view with custom class', function () {
    Menu::add('test', null, null, 'custom-class')
        ->add('test2', null, null, 'custom-class')
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, null, 'custom-class');
        }, null, 'custom-class')
        ->add('test5', null, null, 'custom-class');

    $view = Menu::render();
    expect($view)->toBeString();
    expect($view)->toContain('test');
    expect($view)->toContain('test2');
    expect($view)->toContain('test3');
    expect($view)->toContain('test4');
    expect($view)->toContain('test5');
});

it('render view with custom class and id', function () {
    Menu::add('test', null, null, 'custom-class', 'custom-id')
        ->add('test2', null, null, 'custom-class', 'custom-id')
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, null, 'custom-class', 'custom-id');
        }, null, 'custom-class', 'custom-id')
        ->add('test5', null, null, 'custom-class', 'custom-id');

    $view = Menu::render();
    expect($view)->toBeString();
    expect($view)->toContain('test');
    expect($view)->toContain('test2');
    expect($view)->toContain('test3');
    expect($view)->toContain('test4');
    expect($view)->toContain('test5');
});

it('render view with custom class and id and target', function () {
    Menu::add('test', null, null, 'custom-class', 'custom-id', '_blank')
        ->add('test2', null, null, 'custom-class', 'custom-id', '_blank')
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, null, 'custom-class', 'custom-id', '_blank');
        }, null, 'custom-class', 'custom-id', '_blank')
        ->add('test5', null, null, 'custom-class', 'custom-id', '_blank');

    $view = Menu::render();
    expect($view)->toBeString();
    expect($view)->toContain('test');
    expect($view)->toContain('test2');
    expect($view)->toContain('test3');
    expect($view)->toContain('test4');
    expect($view)->toContain('test5');
});

// check gate

it('render view with gate', function () {
    Menu::add('test1', null, null, 'custom-class', 'custom-id', '_blank', null, null)
        ->add('test2', null, null, 'custom-class', 'custom-id', '_blank', null, null, 'test-gate')
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, null, 'custom-class', 'custom-id', '_blank', null, null, 'test-gate');
        }, null, 'custom-class', 'custom-id', '_blank', null, null, 'test-gate')
        ->add('test5', null, null, 'custom-class', 'custom-id', '_blank', null, null, 'test-gate');

    $view = Menu::render();
    expect($view)->toBeString();
    expect($view)->toContain('test1');
    expect($view)->not->toContain('test2');
    expect($view)->not->toContain('test3');
    expect($view)->not->toContain('test4');
    expect($view)->not->toContain('test5');
});
