<?php

namespace App\Controllers\Options\Traits;

trait NotInAdminBar
{
    public function in_admin_bar()
    {
        return false;
    }
}
