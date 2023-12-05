<?php

namespace App\Models;

use App\Enums\Role;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName, MustVerifyEmail
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
}
