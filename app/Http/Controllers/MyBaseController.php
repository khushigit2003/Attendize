<?php

namespace App\Http\Controllers;

use Auth;


class MyBaseController extends Controller
{
    //checks for validation and authetication of current user.
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
