<?php

namespace App\Controllers\Customizer\Footer;

use App\Controllers\Customizer\Customize;
use App\Providers\CustomizerServiceProvider;
use App\Controllers\Customizer\CustomizerTypeManager;

class FooterCustomizer extends Customize
{
    public static $panel_name = 'footer';
    public static $section_name = 'general_footer';
    public static $section_args = [
        'title' => 'Algemene footer instellingen',
        'priority' => 10
    ];

    public function getPriority(): int
    {
        return 160;
    }

    public function register(): void
    {
        $this->kirki::add_field(
            CustomizerServiceProvider::CUS_CONF_ID,
            [
                'type' => CustomizerTypeManager::RICH_TEXT,
                'section' => static::$section_name,
                'label' => 'Over ' . get_bloginfo('name') . ' content',
                'settings' => $this->getSettingID('About Store')
            ]
        );
    }
}
