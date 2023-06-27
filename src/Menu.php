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

    /**
     * configs
     *
     * @var array
     */
    public $configs = [];

    /**
     * isSubmenu: this is used to determine if the menu is a submenu or not
     *
     * @var bool
     */
    protected bool $isSubmenu = false;

    public function __construct()
    {
        $this->config();
    }

    /**
     * config
     *
     * @return void
     */
    public function config()
    {
        $this->configs = config('menu');
    }

    /**
     * setConfigs
     *
     * @param  array $configs
     * @return Menu
     */
    public function setConfigs(array $configs = [])
    {
        $this->configs = $configs;
        return $this;
    }

    /**
     * setConfig
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return Menu
     */
    public function setConfig($key, $value)
    {
        $this->configs[$key] = $value;
        return $this;
    }

    /**
     * setIsSubmenu
     *
     * @param  bool $isSubmenu
     * @return Menu
     */
    public function setIsSubmenu(bool $isSubmenu = true)
    {
        $this->isSubmenu = $isSubmenu;
        return $this;
    }

    /**
     * setMenu
     *
     * @param  array $menu
     * @return Menu
     */
    public function setMenu(array $menu)
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * Add a new item to the menu
     * @param string $name
     * @param string $routeName
     * @param string $icon
     * @param string $class
     * @param string $id
     * @param string $target
     * @param string $badgeClass
     * @param string,array $gateName
     * @return \Salahhusa9\Menu\Menu
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
        $gateName = null
    ) {
        $item = new Item();
        $item->new($name, $routeName, $icon, $class, $id, $target, $badgeClass, $badgeName, $gateName);
        $this->menu[] = $item;
        return $this;
    }

    /**
     * addItem
     *
     * @param  string $name
     * @param  string $routeName
     * @param  string $icon
     * @param  string $class
     * @param  string $id
     * @param  string $target
     * @param  string $badgeClass
     * @param  string $badgeName
     * @param  string,array $gateName
     * @return \Salahhusa9\Menu\Item
     */
    public function addItem(
        $name,
        $routeName = null,
        $icon = null,
        $class = null,
        $id = null,
        $target = null,
        $badgeClass = null,
        $badgeName = null,
        $gateName = null
    ) {
        $item = new Item();
        $item->new($name, $routeName, $icon, $class, $id, $target, $badgeClass, $badgeName, $gateName);
        $this->menu[] = $item;
        return $item;
    }

    /**
     * addSubmenu - add a submenu to the menu
     *
     * @param string $name
     * @param $callback
     * @param string $icon
     * @param string $class
     * @param string $id
     * @param string $target
     * @param string $badgeClass
     * @param string,array $gateName
     * @return \Salahhusa9\Menu\Menu
     */
    public function addSubmenu($name, $callback, $icon = null, $class = null, $id = null, $target = null, $badgeClass = null, $badgeName = null, $gateName = null)
    {
        $item = new Item();
        $item->new($name, null, $icon, $class, $id, $target, $badgeClass, $badgeName, $gateName);
        $item->addSubmenu($callback);
        $this->menu[] = $item;

        return $this;
    }

    /**
     * Get the menu
     * @return array
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Get the menu
     * @return Menu
     */
    public function get()
    {
        return $this;
    }

    /**
     * getUlClass
     *
     * @return string|null
     */
    public function getUlClass()
    {
        return $this->isSubmenu() ? $this->getConfig('ul_sub_menu_class') : $this->getConfig('ul_class');
    }

    /**
     * getLiClass
     *
     * @return string|null
     */
    public function getLiClass()
    {
        return $this->isSubmenu() ? $this->getConfig('li_sub_menu_class') : $this->getConfig('li_class');
    }

    /**
     * getConfigs
     *
     * @return array
     */
    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * getConfig
     *
     * @param  mixed $key
     * @return string|null
     */
    public function getConfig($key)
    {
        return isset($this->configs[$key]) ? $this->configs[$key] : null;
    }

    /**
     * isSubmenu
     *
     * @return bool
     */
    public function isSubmenu()
    {
        return $this->isSubmenu;
    }

    /**
     * Get the menu as JSON
     * @return string
     */
    public function getMenuAsJson()
    {
        return json_encode($this->menu);
    }

    /**
     * Render the menu
     * @return string
     */
    public function render()
    {
        return view('menu::components.menu', ['menu' => $this])->render();
    }

    /**
     * Render the menu as JSON
     * @return string
     */
    public function renderAsJson()
    {
        return $this->getMenuAsJson();
    }

    /**
     * Render the menu as JSON
     * @return string
     */
    public function renderAsHtml()
    {
        return $this->render();
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
