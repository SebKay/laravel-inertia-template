<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Filament\Forms;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Filament\Tables;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => \trim($this->first_name.' '.$this->last_name),
        );
    }

    protected function allPermissions(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getAllPermissions()->pluck('name')
        );
    }

    public function organisations()
    {
        return $this->belongsToMany(Organisation::class)->withTimestamps();
    }

    public function currentOrganisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function updatePassword(?string $new_password = '')
    {
        if ($new_password && $new_password != $this->password) {
            $this->password = $new_password;

            $this->save();
        }
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(Role::ADMIN->value);
    }

    public function getFilamentName(): string
    {
        return $this->fullName;
    }

    public static function filamentForm()
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
                ->password()
                ->maxLength(255),

            Forms\Components\DateTimePicker::make('email_verified_at'),

            Forms\Components\Select::make('roles')
                ->preload()
                ->multiple()
                ->relationship('roles', 'name')
        ];
    }

    public static function filamentTable()
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

            Tables\Columns\TextColumn::make('organisations')
                ->numeric()
                ->sortable()
                ->getStateUsing(fn (User $user): int => $user->organisations->count()),

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
