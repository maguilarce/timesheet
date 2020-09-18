<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Models\AllowableTime;
use Carbon\Carbon;
use DB;

class AdminHomeController extends Controller
{
    public function dashboard()
    {
        //if (Auth::check()) {
        if (Auth::user()->isAdmin !== 2) {
            //Log::useDailyFiles(storage_path() . '/logs/logins.log');
            Log::useFiles(storage_path() . '/logs/logins.log');
            Log::info(Auth::user()->email.' has logged in');
            
            $allowable =  DB::table('allowable-time')
            ->select('*')
            ->where('month', '=', DB::raw('month(current_date())'))
            ->get();


            return view("admin.views.dashboard",[
                "allowable_hours" => $allowable]);
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
