<?php

use App\Providers\Filament\AdminPanelProvider;
use App\Providers\TelescopeServiceProvider;

arch()->preset()->laravel()
    ->ignoring(AdminPanelProvider::class)
    ->ignoring(TelescopeServiceProvider::class);
