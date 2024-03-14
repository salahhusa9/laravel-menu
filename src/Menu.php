<?php

namespace Salahhusa9\Menu;

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
     */
    protected bool $isSubmenu = false;

    /**
     * customView
     */
    protected ?string $customView = null;

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
     * @param  mixed  $key
     * @param  mixed  $value
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
     * @return Menu
     */
    public function setMenu(array $menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * make
     *
     * @param  string  $for
     * @param  \Closure  $callback
     * @return void
     */
    public function make($for, $callback)
    {
        $menu = new Menu();
        $callback($menu);
        $this->menu[$for] = $menu;

        return $this;
    }

    /**
     * Add a new item to the menu
     *
     * @param  string  $name
     * @param  string  $routeName
     * @param  array  $options
     * @return \Salahhusa9\Menu\Menu
     */
    public function add(
        $name,
        $routeName = null,
        $options = [],
    ) {
        $item = new Item();
        $item->new(
            $name,
            $routeName,
            $options['icon'] ?? null,
            $options['class'] ?? null,
            $options['id'] ?? null,
            $options['target'] ?? null,
            $options['badgeClass'] ?? null,
            $options['badgeName'] ?? null,
            $options['gateName'] ?? null
        );

        $this->menu[] = $item;

        return $this;
    }

    /**
     * addItem
     *
     * @param  string  $name
     * @param  string  $routeName
     * @param  array  $options
     * @return \Salahhusa9\Menu\Item
     */
    public function addItem(
        $name,
        $routeName = null,
        $options = [],
    ) {
        $item = new Item();
        $item->new(
            $name,
            $routeName,
            $options['icon'] ?? null,
            $options['class'] ?? null,
            $options['id'] ?? null,
            $options['target'] ?? null,
            $options['badgeClass'] ?? null,
            $options['badgeName'] ?? null,
            $options['gateName'] ?? null
        );
        $this->menu[] = $item;

        return $item;
    }

    /**
     * addSubmenu - add a submenu to the menu
     *
     * @param  string  $name
     * @param  \Closure  $callback
     * @param  array  $options
     * @return \Salahhusa9\Menu\Menu
     */
    public function addSubmenu($name, $callback, $options = [])
    {
        $item = new Item();
        $item->new(
            $name,
            null,
            $options['icon'] ?? null,
            $options['class'] ?? null,
            $options['id'] ?? null,
            $options['target'] ?? null,
            $options['badgeClass'] ?? null,
            $options['badgeName'] ?? null,
            $options['gateName'] ?? null
        );
        $item->addSubmenu($callback);
        $this->menu[] = $item;

        return $this;
    }

    /**
     * Get the menu
     *
     * @return array
     */
    public function getMenu($name = null)
    {
        if ($name === null) {
            return $this->menu;
        }

        return $this->menu[$name]->menu;
    }

    /**
     * Get the menu
     *
     * @return Menu
     */
    public function get($name = null)
    {
        if ($name === null) {
            return $this;
        }

        return $this->menu[$name];
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
     * @param  mixed  $key
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

    public function customView()
    {
        return $this->customView;
    }

    /**
     * setCustomView
     *
     * @param  mixed $customView
     * @return void
     */
    public function setCustomView($customView)
    {
        $this->customView = $customView;

        return $this;
    }

    /**
     * Get the menu as JSON
     *
     * @return string
     */
    public function getMenuAsJson()
    {
        return json_encode($this->menu);
    }

    /**
     * Render the menu
     *
     * @return string
     */
    public function render()
    {
        return view('menu::components.menu', ['menu' => $this])->render();
    }

    /**
     * Render the menu as JSON
     *
     * @return string
     */
    public function renderAsJson()
    {
        return $this->getMenuAsJson();
    }

    /**
     * Render the menu as JSON
     *
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
