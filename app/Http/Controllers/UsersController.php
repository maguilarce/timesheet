<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use DataTables;
use DateTime;
use Validator;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Auth;

class UsersController extends Controller
{

    public function viewUsers()
    {
        return view('admin.views.view_users');
    }

    public function listUsers()
    {
        return Datatables::queryBuilder(
            DB::table('users')
                ->select('*')
                ->where('status', '<>', 'Inactive')
        )
            ->editColumn("action_btns", function ($users) {
                return '<a href="' . URL::to('/edit-user/' . $users->id) . '" class="btn btn-success edit-user" data-id="' . $users->id . '">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-danger delete-user" data-id="' . $users->id . '">Delete</a>';
            })
            ->rawColumns(["action_btns"])
            ->make(true);
    }


    public function addUser()
    {
        return view("admin.views.add_user");
    }

    public function saveUser(Request $request)
    {
        $parts = explode("@", $request->email);
        $username = $parts[0];
        $validator = Validator::make(array(
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,




        ), array(
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|unique:users",



        ));

        if ($validator->fails()) {
            return redirect("add-user")->withErrors($validator)->withInput();
        } else {

            //print_r($request->all());
            //successfull
            $user = new Users;

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->isAdmin = $request->role;
            $user->status = $request->status;
            $user->username = $username;
            $user->password = bcrypt("Welcome1");

            //saving properties
            $user->save();

            //success message for the view
            Log::useFiles(storage_path() . '/logs/users.log');
            Log::info(Auth::user()->email.' has created a new user: '.$user->username);
            $request->session()->flash("message", "User has been addedd successfully"); //now we can collect this value in our html page
            return redirect("add-user");
        }
    }

    public function deleteUser(Request $request)
    {
        $id = $request->delete_id;

        $user_data = Users::find($id);

        if (isset($user_data->id)) {
            $user_data->delete();
            Log::useFiles(storage_path() . '/logs/users.log');
            Log::info(Auth::user()->email.' has deleted user with id: '.$id);

            echo json_encode(array("status" => 1, "message" => "User deleted successfully"));
        } else {
            echo json_encode(array("status" => 0, "message" => "User does not exist"));
        }
        die();
    }


    public function editUser($id = null)
    {
        $user = Users::find($id);
        

        return view("admin.views.edit_user", ["user" => $user]);
    }

    public function editSaveUser(Request $request)
    {
        $update_id =  $request->update_id;
        $user = Users::find($update_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $parts = explode("@", $request->email);
        $user->username = $parts[0];
        $user->email = $request->email;
        $user->isAdmin = $request->role;
        $user->status = $request->status;
        $user->save();
        $request->session()->flash("message", "User has been updated successfully");
        Log::useFiles(storage_path() . '/logs/users.log');
        Log::info(Auth::user()->email.' has edited user: '.$user->email);
        return redirect('edit-user/' . $update_id);
    }

    public function changePassword(Request $request)
    {
        $user = new Users;

        //check if user is in DB

        if ($user->where('email', '=', $request->email)) {
            // user found
            if ($user->password === $user->password_confirm) {
                //pasword and confirm equals
                $user->email = $request->email;
                $user->password = $request->password;
                $user->isAdmin = '0';
                //$user->save();
                $user->where('email', '=', $request->email)->update(['password' => bcrypt($request->password), 'isAdmin' => '0', 'status' => 'Active']);
                return redirect('/');
            } else {
                //redirect with error password does not match
                $request->session()->flash("message", "Password did not match");
                return redirect('change-password');
            }
        } else {
            //redirect with error user not found
            $request->session()->flash("message", "User not registered as tutor");
            return redirect('change-password');
        }
    }


    public function forgotPasswordView()
    {
        return view("auth.passwords.forgotpasswordview");
    }
    public function forgotPassword(Request $request)
    {

        $user = new Users;

        //check if user is in DB

        if ($user->where('email', '=', $request->email)) {

            // user found
            if ($request->password == $request->password_confirm) {
                //pasword and confirm equals
                $user->email = $request->email;
                $user->password = $request->password;
                $user->isAdmin = '0';
                //$user->save();
                $user->where('email', '=', $request->email)->update(['password' => bcrypt($request->password)]);
                return redirect("/");
            } else {

                //redirect with error password does not match
                $request->session()->flash("message", "Password did not match");

                return redirect('forgot-password-view');
            }
        } else {
            //redirect with error user not found
            $request->session()->flash("message", "User not registered as tutor");
            return redirect('forgot-password-view');
        }
    }
}
