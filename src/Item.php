<?php

namespace Salahhusa9\Menu;

use Salahhusa9\Menu\Facades\Menu;

class Item
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
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
     * @return Salahhusa9\Menu\Item
     */
    public function new(
        $name,
        $routeName,
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

    // add submenu items
    public function addSubmenu($name, $routeName, $icon = null, $class = null, $id = null, $target = null, $badgeClass = null, $badgeName = null)
    {
        $item = new Item();
        $item->new($name, $routeName, $icon, $class, $id, $target, $badgeClass, $badgeName);
        $this->submenu[] = $item;
        return $this;
    }

    // get submenu items not array, as menu class
    public function getSubmenu()
    {
        $menu = new Menu();
        $menu->setIsSubmenu();
        $menu->setMenu($this->submenu);
        return $menu;
    }

    // check if the item has submenu
    public function hasSubmenu()
    {
        return count($this->submenu) > 0;
    }

    // check if the item is active
    public function isActive()
    {
        return request()->routeIs($this->routeName);
    }

    public function addLiActiveClassIfActive()
    {
        if ($this->isActive()) {
            return Menu::getConfig('li_active_class');
        }
        return '';
    }

    // check if has active submenu
    public function hasActiveSubmenu()
    {
        foreach ($this->submenu as $item) {
            if ($item->isActive()) {
                return true;
            }
        }
        return false;
    }

    public function addLiOpenClassIfHaveActiveSubmenu()
    {
        if ($this->hasActiveSubmenu()) {
            return Menu::getConfig('li_sub_menu_open_class');
        }
        return '';
    }

    // check if the item is active or has active submenu
    public function isActiveOrHasActiveSubmenu()
    {
        return $this->isActive() || $this->hasActiveSubmenu();
    }
}