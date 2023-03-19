<?php

namespace Salahhusa9\Menu;

use Salahhusa9\Menu\Item;

/**
 * Menu: A simple menu builder for Laravel 
 */
class Menu
{
    /**
     * @var array
     */
    protected $menu = [];

    public $configs = [];

    protected $isSubmenu = false;

    public function __construct()
    {
        $this->config();
    }

    public function config()
    {
        $this->configs = config('menu');
    }

    public function setConfigs($configs)
    {
        $this->configs = $configs;
    }

    public function setConfig($key, $value)
    {
        $this->configs[$key] = $value;
    }

    public function getConfigs()
    {
        return $this->configs;
    }

    public function getConfig($key)
    {
        return isset($this->configs[$key]) ? $this->configs[$key] : null;
    }

    public function isSubmenu()
    {
        return $this->isSubmenu;
    }

    public function setIsSubmenu($isSubmenu = true)
    {
        $this->isSubmenu = $isSubmenu;
    }

    /**
     * Add a new item to the menu
     * @param string $name
     * @param string $url
     * @param string $icon
     * @param string $class
     * @param string $id
     * @param string $target
     * @param string $badgeClass
     * @param string $badgeName
     * @return Salahhusa9\Menu\Item
     */
    public function add(
        $name,
        $routeName = null,
        $icon = null,
        $class = null,
        $id = null,
        $target = null,
        $badgeClass = null,
        $badgeName = null,
    ) {
        $item = new Item();
        $item->new($name, $routeName, $icon, $class, $id, $target, $badgeClass, $badgeName);
        $this->menu[] = $item;
        return $item;
    }

    /**
     * Render the menu
     * @return string
     */
    public function render()
    {
        return view('menu::menu', ['menu' => $this->menu, 'configs' => $this->configs])->render();
    }

    /**
     * Get the menu
     * @return array
     */
    public function getMenu()
    {
        return $this->menu;
    }

    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    public function get()
    {
        return $this;
    }

    public function getUlClass()
    {
        return $this->isSubmenu() ? $this->getConfig('ul_sub_menu_class') : $this->getConfig('ul_class');
    }

    public function getLiClass()
    {
        return $this->isSubmenu() ? $this->getConfig('li_sub_menu_class') : $this->getConfig('li_class');
    }

    /**
     * Get the menu as JSON
     * @return string
     */
    public function getMenuAsJson()
    {
        return json_encode($this->menu);
    }
}
