<?php

namespace App\Providers;

use App\Models\Whiteboard;
use App\Observers\WhiteboardObserver;
use Filament\Facades\Filament;
use App\Filament\Resources\WhiteboardResource\Pages\ListWhiteboards;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Whiteboard::observe(WhiteboardObserver::class);
//        Filament::serving(function () {
//             Hook khusus untuk ListPosts dari plugin
//            ListWhiteboards::extend(function ($page) {
//                if ($page instanceof ListWhiteboards) {
//                    if (! Auth::user()?->is_admin) {
//                        $page->tableQuery->where('created_by', Auth::id());
//                    }
//                }
//            });
//        });
        FilamentAsset::register([
            Css::make('filament-excalidraw-styles', __DIR__ . '/../../resources/dist/filament-excalidraw.css'),
            Js::make('filament-excalidraw-scripts', __DIR__ . '/../../resources/dist/filament-excalidraw.js'),
        ]);
    }
}
