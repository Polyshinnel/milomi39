<?php

namespace App\Filament\Resources\PriceSections;

use App\Filament\Resources\PriceSections\Pages\ManagePriceSections;
use App\Models\PriceSection;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class PriceSectionResource extends Resource
{
    protected static ?string $model = PriceSection::class;
    protected static ?string $navigationLabel = 'Разделы прайса';
    protected static ?string $modelLabel = 'раздел прайса';
    protected static ?string $pluralModelLabel = 'разделы прайса';
    protected static ?string $recordTitleAttribute = 'title';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->label('Название раздела')->required()->maxLength(255),
                TextInput::make('slug')->label('Адресный якорь')->required()->alphaDash()->unique(ignoreRecord: true)
                    ->helperText('Используется для перехода с карточки главной к этому блоку.'),
                Textarea::make('description')->label('Описание в прайс-листе')->rows(4)->columnSpanFull(),
                Select::make('table_type')->label('Тип таблицы')->options([
                    'service_time_price' => 'Название услуги, время, стоимость',
                    'service_price' => 'Название услуги, стоимость',
                    'purpose_brand' => 'Назначение, бренд',
                ])->required()->default('service_time_price'),
                TextInput::make('sort_order')->label('Порядок')->numeric()->required()->default(0),
                Toggle::make('is_active')->label('Показывать в прайс-листе')->default(true),
                Toggle::make('show_on_home')->label('Показывать на главной')->default(false),
                FileUpload::make('home_image')->label('Изображение карточки')->image()->disk('public')->directory('price-sections')
                    ->visibility('public')->required(fn (Get $get): bool => (bool) $get('show_on_home'))
                    ->helperText('Можно оставить исходное изображение или загрузить новое.'),
                Textarea::make('home_description')->label('Краткое описание карточки')->rows(2)
                    ->required(fn (Get $get): bool => (bool) $get('show_on_home'))->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
                TextColumn::make('title')->label('Раздел')->searchable()->sortable(),
                TextColumn::make('table_type')->label('Таблица')->formatStateUsing(fn (string $state): string => match ($state) {
                    'service_price' => 'Услуга / стоимость', 'purpose_brand' => 'Назначение / бренд', default => 'Услуга / время / стоимость',
                }),
                IconColumn::make('show_on_home')->label('На главной')->boolean(),
                IconColumn::make('is_active')->label('Активен')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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
            'index' => ManagePriceSections::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string { return 'Каталог услуг'; }
}
