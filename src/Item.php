<?php

namespace Salahhusa9\Menu;

use Salahhusa9\Menu\Facades\Menu as FacadesMenu;
use Salahhusa9\Menu\Menu;

class Item
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
    public $routeName;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $class;

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $target;

    /**
     * @var string
     */
    public $badgeClass;

    /**
     * @var string
     */
    public $badgeName;

    /**
     * @var array
     */
    public $submenu = [];

    /**
     * Add a new item to the menu
     * @param string $name
     * @param string $routeName
     * @param string $icon
     * @param string $class
     * @param string $id
     * @param string $target
     * @param string $badgeClass
     * @param string $badgeName
     * @return Item
     */
    public function new(
        $name,
        $routeName = null,
        $icon = null,
        $class = null,
        $id = null,
        $target = null,
        $badgeClass = null,
        $badgeName = null,
    ) {
        $this->name = $name;
        $this->routeName = $routeName;
        $this->icon = $icon;
        $this->class = $class;
        $this->id = $id;
        $this->target = $target;
        $this->badgeClass = $badgeClass;
        $this->badgeName = $badgeName;

        return $this;
    }

    /**
     * addSubmenu - add a submenu to the menu
     *
     * @param  callback $callback
     * @return Item
     */
    public function addSubmenu($callback)
    {
        $menu = new Menu();
        $callback($menu);
        $this->submenu = $menu->getMenu();
        return $this;
    }

    /**
     * addAClassIfActive
     *
     * @return string
     */
    public function addAClassIfActive()
    {
        if ($this->isActive()) {
            return FacadesMenu::getConfig('a_active_class');
        }
        return '';
    }

    /**
     * addLiActiveClassIfActive
     *
     * @return string
     */
    public function addLiActiveClassIfActive()
    {
        if ($this->isActive()) {
            return FacadesMenu::getConfig('li_active_class');
        }
        return '';
    }

    /**
     * addLiOpenClassIfHaveActiveSubmenu
     *
     * @return string
     */
    public function addLiOpenClassIfHaveActiveSubmenu()
    {
        if ($this->hasActiveSubmenu()) {
            return FacadesMenu::getConfig('li_sub_menu_open_class');
        }
        return '';
    }

    /**
     * addLiClassIfHasSubmenu
     *
     * @return bool
     */
    public function hasSubmenu()
    {
        return count($this->submenu) > 0;
    }

    /**
     * addLiClassIfHasSubmenu
     *
     * @return bool
     */
    public function hasActiveSubmenu()
    {
        foreach ($this->submenu as $item) {
            if ($item->isActive()) {
                return true;
            }
        }
        return false;
    }

    /**
     * addLiClassIfHasSubmenu
     *
     * @return bool
     */
    public function isActive()
    {
        return request()->routeIs($this->routeName);
    }

    /**
     * addLiClassIfHasSubmenu
     *
     * @return bool
     */
    public function isActiveOrHasActiveSubmenu()
    {
        return $this->isActive() || $this->hasActiveSubmenu();
    }

    /**
     * addLiClassIfHasSubmenu
     *
     * @return string|null
     */
    public function getUrl()
    {
        if (is_null($this->routeName)) {
            return 'javascript:void(0)';
        }

        return route($this->routeName);
    }

    /**
     * addLiClassIfHasSubmenu
     *
     * @return string
     */
    public function getAClass()
    {
        return $this->hasSubmenu() ? FacadesMenu::getConfig('a_sub_menu_class') : FacadesMenu::getConfig('a_class');
    }

    /**
     * addLiClassIfHasSubmenu
     *
     * @return Menu
     */
    public function getSubmenu()
    {
        $menu = new Menu();
        $menu->setIsSubmenu();
        $menu->setMenu($this->submenu);
        return $menu;
    }
}
