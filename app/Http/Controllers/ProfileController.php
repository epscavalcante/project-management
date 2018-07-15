<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    	return view('profile.index');
    }

    public function password()
    {
    	return view('profile.password');
    }

    public function notification()
    {
    	return view('profile.notification');
    }
}
