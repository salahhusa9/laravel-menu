<?php

namespace Salahhusa9\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Salahhusa9\Menu\Menu
 *
 * @method static \Salahhusa9\Menu\Menu make(string $for, \Closure $callback) : \Salahhusa9\Menu\Menu
 * @method static \Salahhusa9\Menu\Menu add(string $title, $route_name,array $options) : \Salahhusa9\Menu\Menu
 * @method static \Salahhusa9\Menu\Menu addItem(string $title, $route_name,array $options) : \Salahhusa9\Menu\Item
 * @method static \Salahhusa9\Menu\Menu addSubmenu(string $title, \Closure $callback) : \Salahhusa9\Menu\Menu
 */
class Menu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Salahhusa9\Menu\Menu::class;
    }
}
