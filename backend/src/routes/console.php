<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('EcoShop API is running.');
})->purpose('Display an EcoShop status message');
