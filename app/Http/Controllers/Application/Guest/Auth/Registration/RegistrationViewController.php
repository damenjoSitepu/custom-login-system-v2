<?php

namespace App\Http\Controllers\Application\Guest\Auth\Registration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationViewController extends Controller
{
    /**
     * Registration Main View
     * 
     * @param Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('application.guest.auth.registration',[
            'title' => 'CLS | Registration'
        ]);
    }
}
