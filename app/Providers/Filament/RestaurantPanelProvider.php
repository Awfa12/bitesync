<?php

namespace App\Providers\Filament;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Password;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class RestaurantPanelProvider extends PanelProvider
{
    public function boot()
    {
        Filament::serving(function () {
            if (Filament::getCurrentPanel()->getId() === 'restaurant') {
                Password::setDefaultDriver('restaurant_owners');
            }
        });
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('restaurant')
            ->path('restaurant')
            ->login()
            ->profile()
            ->passwordReset()
            ->authGuard('restaurant')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Restaurant/Resources'), for: 'App\\Filament\\Restaurant\\Resources')
            ->discoverPages(in: app_path('Filament/Restaurant/Pages'), for: 'App\\Filament\\Restaurant\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Restaurant/Widgets'), for: 'App\\Filament\\Restaurant\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
