<?php
namespace App\Models\Menu;

class MenuItem extends \Timber\MenuItem
{
    public function get_field($field_name)
    {
        return carbon_get_nav_menu_item_meta($this->id, $field_name);
    }
}
