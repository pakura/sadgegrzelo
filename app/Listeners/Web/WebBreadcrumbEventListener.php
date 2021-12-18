<?php

namespace App\Listeners\Web;

use Illuminate\Support\Collection;
use Models\Abstracts\Model;

class WebBreadcrumbEventListener
{
    /**
     * Handle view composer data.
     *
     * @param  \Illuminate\Contracts\View\View  $event
     * @return void
     */
    public function onBreadcrumbComposer($event)
    {
        if ($event->current instanceof Model) {
            $breadcrumb = app_instance('breadcrumb');

            if ($breadcrumb instanceof Collection
                && ! ($parent = $breadcrumb->last()) instanceof $event->current
            ) {
                $event->current->slug = $parent->slug . '/' . $event->current->slug;

                $breadcrumb->push($event->current);

                if (! is_null($event->current->tab_slug)
                    && ! is_null($event->current->tab_title)
                ) {
                    $current = $event->current->newInstance();

                    $current->slug = $event->current->tab_slug;

                    $current->title = $event->current->tab_title;

                    $breadcrumb->push($current);
                }
            } else {
                app()->instance('breadcrumb', new Collection([$event->current]));
            }
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen([
            'composing: web._partials.breadcrumb',
        ],
            'App\Listeners\Web\WebBreadcrumbEventListener@onBreadcrumbComposer'
        );
    }
}
