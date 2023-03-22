<?php

namespace App\Http\Controllers\Application\Guest\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginViewController extends Controller
{
    /**
     * Login Main View
     * 
     * @param Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('application.guest.auth.login',[
            'title' => 'CLS | Login'
        ]);
    }
}
