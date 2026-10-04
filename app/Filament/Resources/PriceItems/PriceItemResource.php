<?php

namespace App\Filament\Resources\PriceItems;

use App\Filament\Resources\PriceItems\Pages\ManagePriceItems;
use App\Models\PriceItem;
use App\Models\PriceGroup;
use App\Models\PriceSection;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rule;

class PriceItemResource extends Resource
{
    protected static ?string $model = PriceItem::class;
    protected static ?string $navigationLabel = 'Услуги и процедуры';
    protected static ?string $modelLabel = 'услуга или процедура';
    protected static ?string $pluralModelLabel = 'услуги и процедуры';
    protected static ?string $recordTitleAttribute = 'title';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('price_section_id')->label('Раздел прайса')->relationship('section', 'title')->searchable()->preload()->live()->required(),
                Select::make('price_group_id')->label('Группа')->options(fn (Get $get): array => $get('price_section_id')
                    ? PriceGroup::query()->where('price_section_id', $get('price_section_id'))->where('is_active', true)->orderBy('sort_order')->pluck('title', 'id')->all()
                    : [])->searchable()->live()->nullable()->required(fn (Get $get): bool => $get('item_type') === 'brand')
                    ->rules(fn (Get $get): array => $get('price_section_id') ? [Rule::exists('price_groups', 'id')->where('price_section_id', $get('price_section_id'))] : [])
                    ->helperText('Оставьте пустым, если строка идёт прямо в раздел.'),
                Select::make('item_type')->label('Тип элемента')->options(function (Get $get): array {
                    $section = PriceSection::find($get('price_section_id'));

                    return $section?->table_type === 'purpose_brand'
                        ? ['brand' => 'Бренд косметики']
                        : ['service' => 'Услуга', 'procedure' => 'Процедура с описанием'];
                })->rules(function (Get $get): array {
                    $isBrandSection = PriceSection::whereKey($get('price_section_id'))->value('table_type') === 'purpose_brand';

                    return [$isBrandSection ? 'in:brand' : 'in:service,procedure'];
                })->required()->default('service')->live(),
                TextInput::make('title')->label('Название')->required()->maxLength(255),
                Textarea::make('description')->label('Подробное описание')->rows(4)->visible(fn (Get $get): bool => in_array($get('item_type'), ['procedure', 'brand'], true))
                    ->required(fn (Get $get): bool => in_array($get('item_type'), ['procedure', 'brand'], true))->columnSpanFull(),
                TextInput::make('sort_order')->label('Порядок')->numeric()->required()->default(0),
                Toggle::make('is_active')->label('Активен')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
                TextColumn::make('title')->label('Название')->searchable()->sortable(),
                TextColumn::make('item_type')->label('Тип')->formatStateUsing(fn (string $state): string => match ($state) {
                    'procedure' => 'Процедура', 'brand' => 'Бренд', default => 'Услуга',
                }),
                TextColumn::make('section.title')->label('Раздел')->sortable(),
                TextColumn::make('group.title')->label('Группа'),
                IconColumn::make('is_active')->label('Активен')->boolean(),
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
            'index' => ManagePriceItems::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string { return 'Каталог услуг'; }
}
