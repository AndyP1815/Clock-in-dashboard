<?php

namespace App\Filament\Resources\WorkMessages;

use App\Filament\Resources\WorkMessages\Pages\CreateWorkMessage;
use App\Filament\Resources\WorkMessages\Pages\EditWorkMessage;
use App\Filament\Resources\WorkMessages\Pages\ListWorkMessages;
use App\Filament\Resources\WorkMessages\Pages\ViewWorkMessage;
use App\Filament\Resources\WorkMessages\Schemas\WorkMessageForm;
use App\Filament\Resources\WorkMessages\Schemas\WorkMessageInfolist;
use App\Filament\Resources\WorkMessages\Tables\WorkMessagesTable;
use App\Models\WorkMessage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WorkMessageResource extends Resource
{
    protected static ?string $model = WorkMessage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'Berichten';

    public static function form(Schema $schema): Schema
    {
        return WorkMessageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorkMessageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkMessagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorkMessages::route('/'),
            'create' => CreateWorkMessage::route('/create'),
            'view' => ViewWorkMessage::route('/{record}'),
            'edit' => EditWorkMessage::route('/{record}/edit'),
        ];
    }
}
