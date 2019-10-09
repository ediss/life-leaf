<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function notAllowedLogin() {
        return view('block-login');
    }
}
