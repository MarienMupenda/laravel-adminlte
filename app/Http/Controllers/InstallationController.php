<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class InstallationController extends Controller
{
    //

    public function setup()
    {
        \Artisan::call('passport:install');
        echo Artisan::output();

    }
}
