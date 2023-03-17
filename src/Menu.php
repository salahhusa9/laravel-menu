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

    public function config()
    {
        
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
        $routeName,
        $icon = null,
        $class = null,
        $id = null,
        $target = null,
        $badgeClass = null,
        $badgeName = null
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
     * Get the menu as JSON
     * @return string
     */
    public function getMenuAsJson()
    {
        return json_encode($this->menu);
    }

    /**
     * Get the menu as HTML
     * @return string
     */
    public function getMenuAsHtml()
    {
        $html = '';
        foreach ($this->menu as $item) {
            $html .= $item->render();
        }
        return $html;
    }
}
