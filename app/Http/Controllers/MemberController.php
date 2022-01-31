<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    function index($pages = "dashboard")
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin == 1) {
                return redirect('admin');
            } else {
                return view("pages.member.{$pages}", ['userDataProgress' => 100, 'pages' => $pages]);
            }
        } else {
            return redirect('/login');
        }
    }
}
