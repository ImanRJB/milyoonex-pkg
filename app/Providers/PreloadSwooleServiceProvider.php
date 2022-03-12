<?php

namespace Milyoonex\Providers;

use Illuminate\Support\ServiceProvider;

class PreloadSwooleServiceProvider extends ServiceProvider
{
    public function register()
    {
        //All of extra validations (iban, credit_card, national_code, zip_code, ...) in this file
        require(__DIR__ . '/../../helper/validations.php');
    }
}