<?php

namespace Salahhusa9\Menu\Components;

use Illuminate\View\Component;
use Salahhusa9\Menu\Facades\Menu as FacadesMenu;

class Menu extends Component
{
    public $menu;

    public function __construct()
    {
        $this->menu = FacadesMenu::getMenu();
    }

    public function render()
    {
        return view('laravel-menu::components.menu');
    }
}