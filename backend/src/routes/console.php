<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('EcoShop API is running.');
})->purpose('Display an EcoShop status message');
=======
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
>>>>>>> dev
