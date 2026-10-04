<?php

namespace App\Filament\Pages;

use App\Models\ContactSetting;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

class ManageContacts extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;
    protected static ?string $navigationLabel = 'Контакты';
    protected static ?string $title = 'Контакты';
    protected static ?string $slug = 'contacts';
    protected string $view = 'filament.pages.manage-contacts';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(ContactSetting::current()?->attributesToArray() ?? []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('address')->label('Адрес')->required()->rows(2)->columnSpanFull(),
                TextInput::make('phone')->label('Телефон')->required()->maxLength(255),
                TextInput::make('working_hours')->label('График работы')->required()->maxLength(255),
                TextInput::make('telegram_url')->label('Ссылка на Telegram')->url()->required()->maxLength(255),
                TextInput::make('whatsapp_url')->label('Ссылка на WhatsApp')->url()->required()->maxLength(255),
                TextInput::make('max_url')->label('Ссылка на MAX')->url()->required()->maxLength(255),
                TextInput::make('online_booking_url')->label('Ссылка на онлайн-запись')->url()->nullable()->maxLength(255),
                TextInput::make('latitude')->label('Широта')->required()->numeric()->minValue(-90)->maxValue(90),
                TextInput::make('longitude')->label('Долгота')->required()->numeric()->minValue(-180)->maxValue(180),
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $contact = ContactSetting::current() ?? new ContactSetting();
        $contact->fill($data)->save();

        Notification::make()->title('Контакты сохранены')->success()->send();
    }
}
