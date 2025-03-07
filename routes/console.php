<?php

use App\Enums\Environment;
use Illuminate\Support\Facades\Schedule;

Schedule::command(\Spatie\Health\Commands\RunHealthChecksCommand::class)->everyMinute()->environments(Environment::PRODUCTION->value);
