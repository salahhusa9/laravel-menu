<?php

namespace Salahhusa9\Menu;

class Item
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $routeName;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $target;

    /**
     * @var string
     */
    protected $badgeClass;

    /**
     * @var string
     */
    protected $badgeName;
    
    /**
     * @var array
     */
    protected $submenu = [];

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