<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\Users;
use Illuminate\Http\Request;
use DataTables;
use DateTime;
use Validator;
use DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Auth;


class TimesheetController extends Controller
{

    public function addTutorTime()
    {
        $tutors = Users::where(["status" => "Active"])->orderBy('last_name', 'asc')->get();
        return view("admin.views.add_tutor_time", ["tutors" => $tutors, "tutors"]);
    }
    public function viewPendingApprovals()
    {
        Log::useDailyFiles(storage_path() . '/logs/controllers.log');
        Log::info('Testing logs ');
        return view('admin.views.pending_approvals');
    }
    public function listPendingApprovals()
    {
        return Datatables::queryBuilder(
            DB::table('timesheet')
                ->select('*')
                ->where('status', '=', 'Pending Approval')
        )
            ->editColumn("action_btns", function ($timesheet) {
                return '<a href="#" class="btn btn-success pending-approvals-approve" data-id="' . $timesheet->id . '">Approve</a>
                        <a href="javascript:void(0)" class="btn btn-danger pending-approvals-deny" data-id="' . $timesheet->id . '">Deny</a>';
            })
            ->rawColumns(["action_btns"])
            ->make(true);
    }

    public function listGlobalTime()
    {
        $timesheet = Timesheet::query();
        return Datatables::of($timesheet)->make(true);
    }
    public function viewGlobalTime()
    {
        return view("admin.views.view_global");
    }

    public function viewTutorTime()
    {
        $tutors = Users::where(["status" => "Active"])->orderBy('last_name', 'asc')->get();
        return view("admin.views.view_tutor_time", ["tutors" => $tutors, "tutors"]);
    }

    public function generateGlobalReport()
    {
        return view("admin.views.generate_global_report");
    }

    public function generateTutorReport()
    {
        $tutors = Users::where(["status" => "Active"])->orderBy('last_name', 'asc')->get();
        return view("admin.views.generate_tutor_report", ["tutors" => $tutors, "tutors"]);
    }

    public function saveTutorTime(Request $request)
    {
        $validator = Validator::make(array(
            "tutor" => $request->tutor,
            "datepicker" => $request->datepicker,
            "activity" => $request->activity,



        ), array(
            "tutor" => "required",
            "datepicker" => "required",
            "activity" => "required",



        ));
        if ($validator->fails()) {
            return redirect("add-tutor-time")->withErrors($validator)->withInput();
        } else {
            //successfull
            //create model
            $timesheet = new Timesheet;
            //fill out model properties from requests properties (which are HTML Form fields)
            $timesheet->user_id = $request->tutor;

            //transforming date to mysql format
            $date = $request->datepicker;
            $date = new DateTime($date);
            $date = $date->format('Y-m-d');
            $timesheet->date = $date;

            $timesheet->type = $request->activity;
            $timesheet->quantity = $request->hours;
            $timesheet->explanation = $request->explanation;

            //saving properties
            $timesheet->save();

            //success message for the view
            $request->session()->flash("message", "Time has been addedd successfully"); //now we can collect this value in our html page

            //finally, redirect to our html form

            return redirect("add-tutor-time");
        }
    }

    public function denyTime(Request $request)
    {
        $id = $request->deny_id;
        $timesheet = Timesheet::find($id);

        if (isset($timesheet->id)) {
            $timesheet_query = DB::table("timesheet")
                ->where('id', $timesheet->id)
                ->update(['status' => "Denied"]);
            echo json_encode(array("status" => 1, "message" => "Time Denied Successfully"));
        }
    }


    public function approveTime(Request $request)
    {
        $id = $request->approve_id;
        $timesheet = Timesheet::find($id);

        if (isset($timesheet->id)) {
            $timesheet_query = DB::table("timesheet")
                ->where('id', $timesheet->id)
                ->update(['status' => "Approved"]);
            echo json_encode(array("status" => 1, "message" => "Time Approved Successfully"));
        }
    }

    public function viewTutorTimeData(Request $request)
    {
        $tutor_id = $request->tutor;
        $date_from = $request->datepicker1;
        $date_to = $request->datepicker2;

        $date_from_formatted = new Carbon($date_from);
        $date_from_formatted = $date_from_formatted->toDateTimeString();
        $date_to_formatted = new Carbon($date_to);
        $date_to_formatted = $date_to_formatted->toDateTimeString();


        $tutor_query = DB::table("timesheet")
            ->select('*')
            ->where('user_id', '=', $tutor_id)
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=',  $date_to_formatted)
            ->where('status', '=',  'Approved')
            ->get();

        $total_times = DB::table('timesheet')
            ->select(DB::raw("
                     sum(case when type = 'Upswing' then quantity else 0 end) AS Upswing,
                     sum(case when type = 'Special Projects' then quantity  else 0 end) AS SpecialProjects,
                     sum(quantity) as TotalHours"))
            ->where('user_id', '=', $tutor_id)
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('status', '=', 'Approved')
            //->groupBy('timesheet.user_id')
            ->get();

        $user = DB::table("users")
            ->select('*')
            ->where('username', '=', $tutor_id)
            ->get();

        $date_from_formatted = new Carbon($date_from);
        $date_from_formatted = $date_from_formatted->toFormattedDateString();
        $date_to_formatted = new Carbon($date_to);
        $date_to_formatted = $date_to_formatted->toFormattedDateString();

        return view("admin.views.view_tutor_hours", [
            "hours" => $tutor_query,
            "tutor_info" => $user,
            "date_from" => $date_from_formatted,
            "date_to" => $date_to_formatted,
            "total_times" => $total_times
        ]);
    }

    public function globalReport(Request $request)
    {

        $date_from = $request->datepicker1;
        $date_to = $request->datepicker2;

        $date_from_formatted = new Carbon($date_from);
        $date_from_formatted = $date_from_formatted->toDateTimeString();
        $date_to_formatted = new Carbon($date_to);
        $date_to_formatted = $date_to_formatted->toDateTimeString();


        $global_report = DB::table('timesheet')
            /*->select(DB::raw("user_id, 
                     sum(case when type = 'Upswing' then quantity else 0 end) AS Upswing,
                     sum(case when type = 'Special Projects' then quantity  else 0 end) AS SpecialProjects,
                     sum(quantity) as total"))
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->groupBy('user_id')*/
            ->select(DB::raw("concat(first_name,' ',last_name) as Tutor, users.username as UserID, date as Date, type as Type, quantity as Quantity"))
            ->join('users', 'timesheet.user_id', '=', 'users.username')
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('timesheet.status', '=', 'Approved')
            //->groupBy('timesheet.user_id')
            // ->get()->toArray();
            ->get();
        //print_r($global_report);
        return view("admin.views.view_global_report", [
            "report" => $global_report,
            "date_from" => $date_from,
            "date_to" => $date_to
        ]);
    }

    public function downloadGlobalReport()
    {
        return view('admin.views.download_global_report');
    }


    ////////CONTROLLERS FOR TUTOR VIEW////////////////////////////////////////////


    public function addTime()
    {

        return view("tutor.views.add_tutor_time");
    }


    public function viewTime()
    {
        return view("tutor.views.view_tutor_time");
    }



    public function generateReport()
    {

        return view("tutor.views.generate_tutor_report");
    }

    public function saveTime(Request $request)
    {
        $validator = Validator::make(array(

            "datepicker" => $request->datepicker,
            "activity" => $request->activity,



        ), array(

            "datepicker" => "required",
            "activity" => "required",



        ));
        if ($validator->fails()) {
            return redirect("add-time")->withErrors($validator)->withInput();
        } else {
            //successfull
            //create model
            $timesheet = new Timesheet;
            //fill out model properties from requests properties (which are HTML Form fields)
            $timesheet->user_id = Auth::user()->username;

            //transforming date to mysql format
            $date = $request->datepicker;
            $date = new DateTime($date);
            $date = $date->format('Y-m-d');
            $timesheet->date = $date;

            $timesheet->type = $request->activity;
            $timesheet->quantity = $request->hours;
            $timesheet->explanation = $request->explanation;

            //saving properties
            $timesheet->save();

            //success message for the view
            $request->session()->flash("message", "Time has been addedd successfully"); //now we can collect this value in our html page

            //finally, redirect to our html form

            return redirect("add-time");
        }
    }

    public function viewTimeData(Request $request)
    {
        $tutor_id = Auth::user()->username;
        $date_from = $request->datepicker1;
        $date_to = $request->datepicker2;

        $date_from_formatted = new Carbon($date_from);
        $date_from_formatted = $date_from_formatted->toDateTimeString();
        $date_to_formatted = new Carbon($date_to);
        $date_to_formatted = $date_to_formatted->toDateTimeString();


        $tutor_query = DB::table("timesheet")
            ->select('*')
            ->where('user_id', '=', $tutor_id)
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=',  $date_to_formatted)
            ->where('status', '=',  'Approved')
            ->get();

        $total_times = DB::table('timesheet')
            ->select(DB::raw("
                     sum(case when type = 'Upswing' then quantity else 0 end) AS Upswing,
                     sum(case when type = 'Special Projects' then quantity  else 0 end) AS SpecialProjects,
                     sum(quantity) as TotalHours"))
            ->where('user_id', '=', $tutor_id)
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('status', '=', 'Approved')
            ->groupBy('timesheet.user_id')
            ->get();

        $user = DB::table("users")
            ->select('*')
            ->where('username', '=', $tutor_id)
            ->get();

        $date_from_formatted = new Carbon($date_from);
        $date_from_formatted = $date_from_formatted->toFormattedDateString();
        $date_to_formatted = new Carbon($date_to);
        $date_to_formatted = $date_to_formatted->toFormattedDateString();

        return view("tutor.views.view_tutor_hours", [
            "hours" => $tutor_query,
            "tutor_info" => $user,
            "date_from" => $date_from_formatted,
            "date_to" => $date_to_formatted,
            "total_times" => $total_times
        ]);
    }
}
