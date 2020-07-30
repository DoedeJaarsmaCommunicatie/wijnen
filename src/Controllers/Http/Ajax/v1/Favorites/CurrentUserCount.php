<?php

namespace App\Controllers\Http\Ajax\v1\Favorites;

use App\Controllers\Http\Ajax\AjaxController;
use App\Controllers\Functions\General\Favorites;

class CurrentUserCount extends AjaxController
{
    public function isPrivate(): bool
    {
        return false;
    }

    public function actionName(): string
    {
        return 'get_current_user_favorites_count';
    }

    public function hookName(): string
    {
        return 'getCurrentUserFavoritesCount';
    }

    public function getCurrentUserFavoritesCount()
    {
        wp_send_json_success(
            [
                'message' => 'Favorites count',
                'count' => (int) Favorites::get_user_favorites_count(),
            ]
        );
    }
}
