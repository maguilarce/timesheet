<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Auth;

class AdminHomeController extends Controller
{
    public function dashboard()
    {
        //if (Auth::check()) {
        if (Auth::user()->isAdmin !== 2) {
            return view("admin.views.dashboard");
        } else {
            return view("auth.passwords.changepassword");
        }
        //} //else {
        //return redirect('login');
        //}
    }

    /* public function adminLoginForm()
    {
        //return view("admin.views.login_form");
        return view("auth.login");
    }*/
}
