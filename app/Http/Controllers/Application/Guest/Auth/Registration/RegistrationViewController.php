<?php

namespace App\Http\Controllers\Application\Guest\Auth\Registration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Transcendent\Support\Facades\RouteInfo;

class RegistrationViewController extends Controller
{
    /**
     * Registration Main View
     * 
     * @param Illuminate\View\View
     */
    public function __invoke(): View
    {
        dd(RouteInfo::get());
        return view('application.guest.auth.registration',[
            'title' => 'CLS | Registration'
        ]);
    }
}
