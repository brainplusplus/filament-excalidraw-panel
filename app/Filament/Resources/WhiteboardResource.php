<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Enums\WhiteboardType;
use App\Livewire\ExcalidrawWidget;
use App\Models\Whiteboard;
use App\Filament\Resources\WhiteboardResource\Pages\CreateWhiteboard;
use App\Filament\Resources\WhiteboardResource\Pages\EditWhiteboard;
use App\Filament\Resources\WhiteboardResource\Pages\ListWhiteboards;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class WhiteboardResource extends Resource
{
    protected static ?string $model = Whiteboard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title'),
                Select::make('type')
                    ->options(WhiteboardType::class),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('type'),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();
                if (! $user || ! $user->is_admin) {
                    return $query->where('created_by', Auth::id());
                }
            })
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Open Whiteboard')
                    ->icon('heroicon-o-document')
                    ->action(function (Whiteboard $record, $livewire) {
                        $livewire->dispatch('boot-whiteboard-with', whiteboardId: $record->getKey());
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ExcalidrawWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWhiteboards::route('/'),
            'create' => CreateWhiteboard::route('/create'),
            'edit' => EditWhiteboard::route('/{record}/edit'),
        ];
    }
}
