<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BasePage;

class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        if (\app()->environment('local')) {
            $this->form->fill([
                'email' => \config('app.seed.users.super.email'),
                'password' => \config('app.seed.users.super.password'),
                'remember' => true,
            ]);
        }
    }
}
