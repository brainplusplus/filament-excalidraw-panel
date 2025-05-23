<?php

namespace App\Filament\Resources\WhiteboardResource\Pages;


use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use App\Livewire\ExcalidrawWidget;
use App\Filament\Resources\WhiteboardResource;
use Illuminate\Foundation\Vite;
use Illuminate\Support\HtmlString;

class ListWhiteboards extends ListRecords
{
    protected static string $resource = WhiteboardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ExcalidrawWidget::class,
        ];
    }

    public function mount(): void
    {
        /* Playground with Vite (Faster vs package Esbuild commands)  */
//        $this->loadPlaygroundViteExcalidrawBundle();

//        $this->registerFunctionForAutoClickOnPageLoad();
    }

    private function loadPlaygroundViteExcalidrawBundle()
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            fn() => app(Vite::class)('resources/js/dev-excalidraw.js'),
        );
    }

    /**
     * @return void
     */
    public function registerFunctionForAutoClickOnPageLoad(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_END,
            fn() => new HtmlString("
                <script>
                    setTimeout(() => {
                        document.querySelector('tbody div > div > button > span').click()
                    }, 1200)
                </script>
            ")
        );
    }
}
