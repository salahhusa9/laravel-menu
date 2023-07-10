<?php

namespace Salahhusa9\Menu\View\Components;

use Illuminate\View\Component;
use Salahhusa9\Menu\Facades\Menu as FacadesMenu;
use Salahhusa9\Menu\Menu as MenuMenu;

class Menu extends Component
{
    public MenuMenu $menu;

    public function __construct(public $for = null)
    {
        $this->menu = FacadesMenu::get($for);
    }

    public function render()
    {
        return view($this->menu->customView() ?: 'menu::components.menu');
    }
}