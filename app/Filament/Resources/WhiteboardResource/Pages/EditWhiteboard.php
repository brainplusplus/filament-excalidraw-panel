<?php

namespace App\Filament\Resources\WhiteboardResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use App\Filament\Resources\WhiteboardResource;
use App\Livewire\ExcalidrawWidget;
use App\Models\Whiteboard;
use Illuminate\Foundation\Vite;

class EditWhiteboard extends EditRecord
{
    protected static string $resource = WhiteboardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Open Whiteboard')
                ->icon('heroicon-o-document')
                ->action(function (Whiteboard $record, $livewire) {
                    $livewire->dispatch('boot-whiteboard-with', whiteboardId: $record->getKey());
                }),
            Actions\DeleteAction::make()
                ->outlined(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ExcalidrawWidget::class,
        ];
    }
}
