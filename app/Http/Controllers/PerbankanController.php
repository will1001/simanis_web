<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\BadanUsaha;
use Illuminate\Support\Str;



class PerbankanController extends Controller
{
    function index($pages = "dashboard", $subPages = "")
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin == 1) {
                return redirect('admin');
            } else {
                if ($subPages != "") {
                    return view("pages.perbankan.{$subPages}", ['BadanUsaha' => $BadanUsaha, 'userDataProgress' => $userDataProgress, 'pages' => $pages,'fields'=>$this->fields]);
                } else {
                    // dd($BadanUsaha);
                    return view("pages.perbankan.{$pages}", ['pages' => $pages]);
                }
            }
        } else {
            return redirect('/login');
        }
    }
}
