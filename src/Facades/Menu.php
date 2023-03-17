<?php

namespace Salahhusa9\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Salahhusa9\Menu\Menu
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Salahhusa9\Menu\Menu::class;
    }
}
