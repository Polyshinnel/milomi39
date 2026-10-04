<?php

namespace App\Filament\Resources\SpecialOffers;

use App\Filament\Resources\SpecialOffers\Pages\ManageSpecialOffers;
use App\Models\SpecialOffer;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SpecialOfferResource extends Resource
{
    protected static ?string $model = SpecialOffer::class;
    protected static ?string $navigationLabel = 'Спецпредложения';
    protected static ?string $modelLabel = 'спецпредложение';
    protected static ?string $pluralModelLabel = 'спецпредложения';
    protected static ?string $recordTitleAttribute = 'home_title';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Страница предложения')
                ->schema([
                    TextInput::make('slug')->label('Slug страницы')->required()->alphaDash()->unique(ignoreRecord: true)
                        ->helperText('Адрес страницы: /special-offers/{slug}.'),
                    FileUpload::make('hero_image')->label('Изображение hero banner')->image()->disk('public')->directory('special-offers')->visibility('public')->required(),
                    TextInput::make('hero_title')->label('Заголовок hero banner')->required()->maxLength(255),
                    Textarea::make('hero_description')->label('Описание hero')->rows(3)->required()->columnSpanFull(),
                ])->columns(2),
            Section::make('Карточка на главной')
                ->schema([
                    FileUpload::make('home_image')->label('Изображение для главной')->image()->disk('public')->directory('special-offers')->visibility('public')->required(),
                    TextInput::make('home_title')->label('Текст для главной')->required()->maxLength(255),
                    Textarea::make('home_description')->label('Описание для главной')->rows(3)->required()->columnSpanFull(),
                ])->columns(2),
            TextInput::make('sort_order')->label('Порядок отображения')->numeric()->required()->default(0),
            Toggle::make('is_active')->label('Показывать на сайте')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
                TextColumn::make('home_title')->label('Предложение')->searchable()->sortable(),
                TextColumn::make('slug')->label('Адрес')->copyable(),
                IconColumn::make('is_active')->label('Активно')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => ManageSpecialOffers::route('/')];
    }
}
