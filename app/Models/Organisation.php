<?php

namespace App\Models;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public static function filamentForm()
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('user_id')
                ->label('Owner')
                ->required()
                ->options(User::all()->pluck('full_name', 'id')->toArray())
                ->default(fn (): int => \auth()->id() ?: null),
        ];
    }

    public static function filamentTable()
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('user_id')
                ->label('Owner')
                ->numeric()
                ->sortable()
                ->getStateUsing(fn (Organisation $organisation): string => $organisation->user->full_name),

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
