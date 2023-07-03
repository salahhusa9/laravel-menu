<?php

namespace Salahhusa9\Menu\View\Components;

use Illuminate\View\Component;
use Salahhusa9\Menu\Facades\Menu as FacadesMenu;
use Salahhusa9\Menu\Menu as MenuMenu;

class Menu extends Component
{
    public MenuMenu $menu;

    public function __construct(public string $for)
    {
        $this->menu = FacadesMenu::get($for);
    }

    public function render()
    {
        return view('menu::components.menu');
    }
}