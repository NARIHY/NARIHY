<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Navigation;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Vous pouvez personnaliser ici la navigation dans Filament
        Filament::navigation(function (NavigationGroup $group) {
            $group->addItem(
                NavigationItem::make('Médias') // Nom de l'item
                    ->icon('heroicon-o-photo') // Icône de l'item
                    ->route('filament.resources.media.index') // Lien vers l'index de la ressource Media
            );
        });

        // Vous pouvez également ajouter des actions, des pages ou des widgets ici
        // Exemple : Ajouter un widget personnalisé à la page d'accueil de Filament
        // Filament::registerWidgets([
        //     \App\Filament\Widgets\ExampleWidget::class,
        // ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
