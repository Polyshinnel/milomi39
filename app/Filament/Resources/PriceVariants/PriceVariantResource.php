<?php

namespace App\Filament\Resources\PriceVariants;

use App\Filament\Resources\PriceVariants\Pages\ManagePriceVariants;
use App\Models\PriceVariant;
use App\Models\PriceItem;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PriceVariantResource extends Resource
{
    protected static ?string $model = PriceVariant::class;
    protected static ?string $navigationLabel = 'Цены и длительность';
    protected static ?string $modelLabel = 'вариант цены';
    protected static ?string $pluralModelLabel = 'цены и длительность';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('price_item_id')->label('Услуга / процедура')->options(fn (): array => PriceItem::query()
                    ->where('is_active', true)->whereHas('section', fn ($query) => $query->where('table_type', '!=', 'purpose_brand'))
                    ->orderBy('title')->pluck('title', 'id')->all())->searchable()->preload()->live()->required(),
                TextInput::make('duration')->label('Время')->maxLength(255)->visible(function (Get $get): bool {
                    return PriceItem::with('section')->find($get('price_item_id'))?->section?->table_type === 'service_time_price';
                }),
                TextInput::make('price')->label('Стоимость (руб.)')->numeric()->minValue(0),
                Checkbox::make('price_from')->label('Показывать «от»'),
                TextInput::make('note')->label('Примечание')->maxLength(255),
                TextInput::make('sort_order')->label('Порядок')->numeric()->required()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item.title')->label('Услуга')->searchable()->sortable(),
                TextColumn::make('duration')->label('Время'),
                TextColumn::make('price')->label('Стоимость')->formatStateUsing(fn ($state, PriceVariant $record): string => $state === null ? 'Уточнить' : (($record->price_from ? 'от ' : '').number_format((float) $state, 0, ',', ' ').' ₽')),
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
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
            'index' => ManagePriceVariants::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string { return 'Каталог услуг'; }
}
