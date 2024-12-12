<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('horizon:snapshot')->everyFiveMinutes();
Schedule::command(\Spatie\Health\Commands\RunHealthChecksCommand::class)->everyMinute()->environments('production');
