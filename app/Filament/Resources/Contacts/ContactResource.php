<?php

namespace App\Filament\Resources\Contacts;

use App\Filament\Resources\Contacts\Pages\ManageContacts;
use App\Models\Contact;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return __('Contact');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Contacts');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('phone')
                    ->label(__('Phone'))
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->required(),
                TextInput::make('age')
                    ->label(__('Age'))
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(120)
                    ->required(),
                TextInput::make('country')
                    ->label(__('Country'))
                    ->required(),
                TextInput::make('course')
                    ->label(__('Course'))
                    ->required(),
                Select::make('pricing_plan_id')
                    ->label(__('Pricing Plan'))
                    ->relationship('pricingPlan', 'title')
                    ->searchable()
                    ->preload(),
                Textarea::make('message')
                    ->label(__('Message'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('Name')),
                TextEntry::make('phone')
                    ->label(__('Phone')),
                TextEntry::make('email')
                    ->label(__('Email')),
                TextEntry::make('age')
                    ->label(__('Age')),
                TextEntry::make('country')
                    ->label(__('Country')),
                TextEntry::make('course')
                    ->label(__('Course')),
                TextEntry::make('pricingPlan.title')
                    ->label(__('Pricing Plan'))
                    ->placeholder('-'),
                TextEntry::make('message')
                    ->label(__('Message'))
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('Phone'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                TextColumn::make('country')
                    ->label(__('Country'))
                    ->searchable(),
                TextColumn::make('course')
                    ->label(__('Course'))
                    ->searchable(),
                TextColumn::make('pricingPlan.title')
                    ->label(__('Pricing Plan'))
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
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
            'index' => ManageContacts::route('/'),
        ];
    }
}