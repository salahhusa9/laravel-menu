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

it('Test Store Multiple Menu', function () {

    Menu::make('MyNavBar', function ($menu) {
        $menu->add('test')
            ->add('test2')
            ->addSubmenu('test3', function ($menu) {
                $menu->add('test4');
            })
            ->add('test5');
    });

    // test
    $menu = Menu::getMenu('MyNavBar');

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
    Menu::add('test', null, ['class' => 'custom-class'])
        ->add('test2', null, ['class' => 'custom-class'])
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, ['class' => 'custom-class']);
        }, ['class' => 'custom-class'])
        ->add('test5', null, ['class' => 'custom-class']);

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
    Menu::add('test', null, ['class' => 'custom-class'])
        ->add('test2', null, ['class' => 'custom-class'])
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, ['class' => 'custom-class']);
        }, ['class' => 'custom-class'])
        ->add('test5', null, ['class' => 'custom-class']);

    $view = Menu::render();
    expect($view)->toBeString();
    expect($view)->toContain('test');
    expect($view)->toContain('test2');
    expect($view)->toContain('test3');
    expect($view)->toContain('test4');
    expect($view)->toContain('test5');
});

it('render view with custom class and id', function () {
    Menu::add('test', null, ['class' => 'custom-class', 'id' => 'custom-id'])
        ->add('test2', null, ['class' => 'custom-class', 'id' => 'custom-id'])
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, ['class' => 'custom-class', 'id' => 'custom-id']);
        }, ['class' => 'custom-class', 'id' => 'custom-id'])
        ->add('test5', null, ['class' => 'custom-class', 'id' => 'custom-id']);

    $view = Menu::render();
    expect($view)->toBeString();
    expect($view)->toContain('test');
    expect($view)->toContain('test2');
    expect($view)->toContain('test3');
    expect($view)->toContain('test4');
    expect($view)->toContain('test5');
});

it('render view with custom class and id and target', function () {
    Menu::add('test', null, ['class' => 'custom-class', 'id' => 'custom-id', 'target' => '_blank'])
        ->add('test2', null, ['class' => 'custom-class', 'id' => 'custom-id', 'target' => '_blank'])
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, ['class' => 'custom-class', 'id' => 'custom-id', 'target' => '_blank']);
        }, ['class' => 'custom-class', 'id' => 'custom-id', 'target' => '_blank'])
        ->add('test5', null, ['class' => 'custom-class', 'id' => 'custom-id', 'target' => '_blank']);

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
    Menu::add('test1', null, ['class' => 'custom-class', 'gateName' => 'gateName'])
        ->add('test2', null, ['class' => 'custom-class', 'gateName' => 'gateName'])
        ->addSubmenu('test3', function ($menu) {
            $menu->add('test4', null, ['class' => 'custom-class', 'gateName' => 'gateName']);
        }, ['class' => 'custom-class', 'gateName' => 'gateName'])
        ->add('test5', null, ['class' => 'custom-class', 'gateName' => 'gateName']);

    $view = Menu::render();
    expect($view)->toBeString();
    expect($view)->toContain('test1');
    expect($view)->toContain('test2');
    expect($view)->toContain('test3');
    expect($view)->toContain('test4');
    expect($view)->toContain('test5');
});
