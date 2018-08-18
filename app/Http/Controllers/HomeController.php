<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->middleware('auth');
        $this->project = $project;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with(['projects' => $this->project->all()]);
    }
}
