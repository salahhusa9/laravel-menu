<?php

namespace Salahhusa9\Menu\Item;

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
    protected $children = [];

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
        $badgeName = null
    ) {
        return $this;
    }
}
