<?php

namespace Salahhusa9\Menu;

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
     * @param array $submenu
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
        $submenu = []
    ) {
        $this->name = $name;
        $this->routeName = $routeName;
        $this->icon = $icon;
        $this->class = $class;
        $this->id = $id;
        $this->target = $target;
        $this->badgeClass = $badgeClass;
        $this->badgeName = $badgeName;
        $this->submenu = $submenu;

        return $this;
    }
}