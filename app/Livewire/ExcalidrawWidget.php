<?php

namespace App\Livewire;

use Filament\Widgets\Widget;

class ExcalidrawWidget extends Widget
{
    protected static string $view = 'livewire.filament-excalidraw.excalidraw-widget';

    protected int | string | array $columnSpan = 'full';
}
