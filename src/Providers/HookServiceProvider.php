<?php

namespace App\Providers;

use App\Bootstrap\Container;
use App\Controllers\Hooks\Actions\Action;
use App\Controllers\Hooks\Filters\Filter;
use App\Controllers\Hooks\Actions\Views\General\BodyHTMLCode;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var Action[]
     */
    protected $actions = [];

    /**
     * @var Filter[]
     */
    protected $filters = [];
    protected $actions_unhook = [];
    protected $filters_unhook = [];

    public function boot(): void
    {
        $this->filters = apply_filters('wijnen/providers/filters', []);

        $this->actions = apply_filters('wijnen/providers/actions', [
        	BodyHTMLCode::class,
        ]);

        $this->filters_unhook = apply_filters('wijnen/providers/filters/unhook', [
        	[
        		'hook' => 'the_content',
        		'name' => 'wpautop',
		        'priority' => 10
	        ]
        ]);

        $this->actions_unhook = apply_filters('wijnen/providers/actions/unhook', []);
    }

    public function register(): void
    {
        foreach ($this->actions as $action) {
            if (class_exists($action) && is_subclass_of($action, Action::class)) {
                $called = Container::get($action);
                add_action($called->hook(), [$called, 'action'], $called->priority(), $called->parameterCount());
            } else {
                add_action($action['hook'], $action['action']);
            }
        }

        foreach ($this->filters as $filter) {
            if (class_exists($filter) && is_subclass_of($filter, Filter::class)) {
                $called = Container::get($filter);
                add_filter($called->hook(), [$called, 'filter'], $called->priority(), $called->parameterCount());
            } else {
                add_filter($filter['hook'], $filter['action']);
            }
        }

        foreach ($this->actions_unhook as $item) {
            remove_action($item['hook'], $item['name'], $item['priority']);
        }

        foreach ($this->filters_unhook as $hook => $item) {
            remove_filter($item['hook'], $item['name'], $item['priority']);
        }
    }
}
