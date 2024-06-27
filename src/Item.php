<?php

namespace Salahhusa9\Menu;

use Closure;
use Salahhusa9\Menu\Facades\Menu as FacadesMenu;

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

    protected array $routeData = [];

    public $url;

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
     * @var string|Closure
     */
    public $badgeName;

    /**
     * @var array
     */
    public $submenu = [];

    /**
     * @var string array
     */
    public $gateName = null;

    /**
     * Add a new item to the menu
     *
     * @param  string  $routeName
     * @param  string  $icon
     * @param  string  $class
     * @param  string  $id
     * @param  string  $target
     * @param  string  $badgeClass
     * @param  string|Closure  $badgeName
     * @param string array $gateName
     * @return Item
     */
    public function new(
        string $name
    ) {
        $this->name = $name;

        return $this;
    }

    public function route(string $name, array $data = [])
    {
        $this->routeName = $name;
        $this->routeData = $data;

        return $this;
    }

    public function url(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function icon(string $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function class(string $class)
    {
        $this->class = $class;

        return $this;
    }

    public function id(string $id)
    {
        $this->id = $id;

        return $this;
    }

    public function target(string $target)
    {
        $this->target = $target;

        return $this;
    }

    public function badge(string $badgeClass, string|Closure $badgeName)
    {
        $this->badgeClass = $badgeClass;
        $this->badgeName = $badgeName;

        return $this;
    }

    public function gate(string $gateName)
    {
        $this->gateName = $gateName;

        return $this;
    }

    /**
     * addSubmenu - add a submenu to the menu
     *
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
    public function hasActiveSubmenu($menu = null)
    {
        if (is_null($menu)) {
            $menu = $this->submenu;
        }

        foreach ($menu as $item) {
            if ($item->hasSubmenu() && $item->hasActiveSubmenu($item->submenu)) {
                return true;
            }

            if ($item->isActive()) {
                return true;
            }
        }

        return false;
    }

    /**
     * isActive
     *
     * @return bool
     */
    public function isActive()
    {
        if (request()->routeIs($this->routeName) or request()->url() == $this->url) {
            return true;
        } else { // check child routes
            return $this->hasActiveSubmenu(
                $this->submenu
            );
        }
    }

    /**
     * canShow
     *
     * @return bool
     */
    public function canShow()
    {
        if (is_null($this->gateName)) {
            return true;
        }

        if (auth()->check() === false) {
            return true;
        }

        if (is_array($this->gateName)) {
            foreach ($this->gateName as $gateName) {
                if (auth()->user()->can($gateName)) {
                    return true;
                }
            }

            return false;
        }

        return auth()->user()->can($this->gateName);
    }

    /**
     * setGate
     *
     * @param  mixed  $gateName
     * @return Item
     */
    public function setGate($gateName)
    {
        $this->gateName = $gateName;

        return $this;
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
        if (is_null($this->routeName) and is_null($this->url)) {
            return 'javascript:void(0)';
        }

        if (! is_null($this->url)) {
            return $this->url;
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
        return ($this->hasSubmenu() ? FacadesMenu::getConfig('a_sub_menu_class') : FacadesMenu::getConfig('a_class')).' '.$this->getClass();
    }

    /**
     * getClass
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
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
