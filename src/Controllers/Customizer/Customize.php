<?php

namespace App\Controllers\Customizer;

use Kirki;
use App\Helpers\Str;

abstract class Customize
{
    public static $panel_name = null;
    public static $section_name = null;
    public static $section_args = [];
    abstract public function register();

    /**
     * @var Kirki $kirki
     */
    protected $kirki;

    public function __construct(Kirki $kirki)
    {
        $this->kirki = $kirki;
    }

    final public function registerPanel()
    {
        $this->kirki::add_panel(
            static::$panel_name,
            [
                'title' => $this->getTitle(),
                'priority' => $this->getPriority(),
                'description' => $this->getDescription(),
            ]
        );
    }

    public function getDescription(): string
    {
        return '';
    }

    public function getTitle(): string
    {
        return static::$panel_name;
    }

    public function getPriority(): int
    {
        return 10;
    }

    final public function registerSection(): void
    {
        $this->kirki::add_Section(
            static::$section_name,
            array_merge(static::$section_args, ['panel_id' => static::$panel_name])
        );
    }

    /*
     * Helper classes
     */
    protected function getSettingID($name)
    {
        return '_wijnen_' . Str::slug($name);
    }
}
