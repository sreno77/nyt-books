<?php

use App\Invokables\DetermineWinnersInvokable;
use Illuminate\Support\Facades\Schedule;

Schedule::call(new DetermineWinnersInvokable)->everyMinute();
