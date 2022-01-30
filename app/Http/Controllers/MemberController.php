<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    function index()
    {
        if (Auth::check()) {
            return view('pages.member', ['userDataProgress' => 100]);
        } else {
            return redirect('/login');
        }
    }
}
