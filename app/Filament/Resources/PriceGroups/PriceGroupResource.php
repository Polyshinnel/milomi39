<?php

namespace App\Filament\Resources\PriceGroups;

use App\Filament\Resources\PriceGroups\Pages\ManagePriceGroups;
use App\Models\PriceGroup;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class PriceGroupResource extends Resource
{
    protected static ?string $model = PriceGroup::class;
    protected static ?string $navigationLabel = 'Группы';
    protected static ?string $modelLabel = 'группа';
    protected static ?string $pluralModelLabel = 'группы';
    protected static ?string $recordTitleAttribute = 'title';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('price_section_id')->label('Раздел прайса')->relationship('section', 'title')->searchable()->preload()->required(),
                TextInput::make('title')->label('Название группы')->required()->maxLength(255),
                TextInput::make('sort_order')->label('Порядок')->numeric()->required()->default(0),
                Toggle::make('is_active')->label('Активна')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
                TextColumn::make('title')->label('Группа')->searchable()->sortable(),
                TextColumn::make('section.title')->label('Раздел')->sortable(),
                IconColumn::make('is_active')->label('Активна')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePriceGroups::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string { return 'Каталог услуг'; }
}
