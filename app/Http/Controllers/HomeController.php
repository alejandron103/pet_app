<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::whereNotIn('id', [ $request->user()->id ])->whereIn('breed_id', $request->user()->breed->type->breeds()->pluck('id')->toArray())->get();
        return view('home', ['user' => $request->user(), 'users' => $users]);
    }
}
