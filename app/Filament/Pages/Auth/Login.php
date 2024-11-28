<?php

namespace App\Filament\Pages\Auth;

use App\Enums\Role;
use App\Models\User;
use Filament\Pages\Auth\Login as BasePage;

class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        if (\app()->environment('local')) {
            $this->form->fill([
                'email' => User::hasRoles([Role::ADMIN->value])->first()->email,
                'password' => '12345',
                'remember' => true,
            ]);
        }
    }
}
