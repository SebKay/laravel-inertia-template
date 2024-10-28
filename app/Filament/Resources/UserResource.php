<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'full_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::formSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::tableSchema())
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function formSchema()
    {
        return [
            Forms\Components\TextInput::make('first_name')
                ->autofocus()
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('last_name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->maxLength(255),

            Forms\Components\TextInput::make('password')
                ->required(fn (string $operation): bool => $operation === 'create')
                ->password()
                ->afterStateHydrated(function (Forms\Components\TextInput $component, $state) {
                    $component->state('');
                })
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->maxLength(255),

            Forms\Components\DateTimePicker::make('email_verified_at'),

            Forms\Components\Select::make('roles')
                ->preload()
                ->multiple()
                ->relationship('roles', 'name'),
        ];
    }

    public static function tableSchema()
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->getStateUsing(fn ($record) => $record->fullName)
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('email')
                ->searchable()
                ->sortable(),

            Tables\Columns\IconColumn::make('email_verified')
                ->getStateUsing(fn ($record) => $record->email_verified_at)
                ->boolean()
                ->sortable(),

            Tables\Columns\TextColumn::make('roles')
                ->getStateUsing(fn ($record) => $record->roles->pluck('name')->join(', '))
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
