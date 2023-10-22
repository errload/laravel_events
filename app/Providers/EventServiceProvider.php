<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Models\Event as Events;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // all events
            $event->menu->add(['header' => 'ВСЕ СОБЫТИЯ']);

            $events = Events::all()->map(function (Events $item) {
                return [
                    'text' => $item->title,
                    'url' => route('get_event', $item->id),
                    'icon' => ''
                ];
            });

            $event->menu->add(...$events);

            // my events
            $event->menu->add(['header' => 'МОИ СОБЫТИЯ']);

            $user = User::find(Auth::id());
            $events = $user->events->map(function (Events $item) {
                return [
                    'text' => $item->title,
                    'url' => route('get_event', $item->id),
                    'icon' => ''
                ];
            });

            $event->menu->add(...$events);
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
