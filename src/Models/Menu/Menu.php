<?php
namespace App\Models\Menu;

class Menu extends \Timber\Menu
{
    public $MenuItemClass = \App\Models\Menu\MenuItem::class;
}
