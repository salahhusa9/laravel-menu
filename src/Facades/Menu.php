<?php

namespace Salahhusa9\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Salahhusa9\Menu\Menu
 */
class Menu extends Facade
{
    /**
 * @see \Salahhusa9\Menu\Menu
 */

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
