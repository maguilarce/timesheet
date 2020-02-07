<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Input;
use App\Models\Timesheet;
use Carbon\Carbon;
use Auth;

class ExportExcelController extends Controller
{
    public function downloadExcel(Request $request)
    {

        $date_from = $request->datepicker1;
        $date_to = $request->datepicker2;

        $date_from_formatted = new Carbon($date_from);
        $date_from_formatted = $date_from_formatted->toDateTimeString();
        $date_to_formatted = new Carbon($date_to);
        $date_to_formatted = $date_to_formatted->toDateTimeString();



        $data = DB::table('timesheet')
            /*->select(DB::raw("concat(first_name,' ',last_name) as Tutor, users.username as UserID, 
                     sum(case when type = 'Upswing' then quantity else 0 end) AS Upswing,
                     sum(case when type = 'Special Projects' then quantity  else 0 end) AS SpecialProjects,
                     sum(quantity) as TotalHours"))
            ->join('users', 'timesheet.user_id', '=', 'users.username')
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('timesheet.status', '=', 'Approved')
            ->groupBy('timesheet.user_id')*/
            ->select(DB::raw("concat(first_name,' ',last_name) as Tutor, users.username as UserID, dayname(date) as Weekday ,date as Date, sum(quantity) as Total"))
            ->join('users', 'timesheet.user_id', '=', 'users.username')
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('timesheet.status', '=', 'Approved')
            ->groupBy('timesheet.user_id')
            ->groupBy('timesheet.date')
            ->get()->toArray();


        $data = json_decode(json_encode($data), true);

        Excel::create('HCC_Online_Tutor_Timesheet_Global_Report_' . date("Y-m-d"), function ($excel) use ($data, $date_from, $date_to) {
            $excel->sheet('mySheet', function ($sheet) use ($data, $date_from, $date_to) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('HCC Online Tutoring Services');
                });
                $sheet->cell('A2', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('Tutoring Global Report');
                });
                $sheet->cell('A3', function ($cell) use ($date_from, $date_to) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('From ' . $date_from . ' to ' . $date_to);
                });
                $sheet->cell('A5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('B5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('C5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('D5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('E5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A5', true);
            });
        })->export('xlsx');
    }



    public function downloadExcelTutor(Request $request)
    {
        $tutor = $request->tutor;
        $date_from = $request->datepicker1;
        $date_to = $request->datepicker2;

        $date_from_formatted = new Carbon($date_from);
        $date_from_formatted = $date_from_formatted->toDateTimeString();
        $date_to_formatted = new Carbon($date_to);
        $date_to_formatted = $date_to_formatted->toDateTimeString();


        $data = DB::table('timesheet')
            ->select(DB::raw("concat(first_name,' ',last_name) as Tutor, users.username as UserID, dayname(date) as Weekday ,date as Date, sum(quantity) as Total"))
            ->join('users', 'timesheet.user_id', '=', 'users.username')
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('timesheet.status', '=', 'Approved')
            ->where('timesheet.user_id', '=', $tutor)
            ->groupBy('timesheet.user_id')
            ->groupBy('timesheet.date')
            ->get()->toArray();

        $data = json_decode(json_encode($data), true);

        Excel::create('HCC_Online_Tutor_Timesheet_Global_Report_' . date("Y-m-d"), function ($excel) use ($data, $date_from, $date_to) {
            $excel->sheet('mySheet', function ($sheet) use ($data, $date_from, $date_to) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('HCC Online Tutoring Services');
                });
                $sheet->cell('A2', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('Tutoring Global Report');
                });
                $sheet->cell('A3', function ($cell) use ($date_from, $date_to) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('From ' . $date_from . ' to ' . $date_to);
                });
                $sheet->cell('A5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('B5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('C5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('D5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('E5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A5', true);
            });
        })->export('xlsx');
    }


    public function tutorDownloadExcel(Request $request)
    {
        $tutor = Auth::user()->username;
        $date_from = $request->datepicker1;
        $date_to = $request->datepicker2;

        $date_from_formatted = new Carbon($date_from);
        $date_from_formatted = $date_from_formatted->toDateTimeString();
        $date_to_formatted = new Carbon($date_to);
        $date_to_formatted = $date_to_formatted->toDateTimeString();


        $data = DB::table('timesheet')
            /*->select(DB::raw("concat(first_name,' ',last_name) as Tutor, users.username as UserID, 
                     sum(case when type = 'Upswing' then quantity else 0 end) AS Upswing,
                     sum(case when type = 'Special Projects' then quantity  else 0 end) AS SpecialProjects,
                     sum(quantity) as TotalHours"))
            ->join('users', 'timesheet.user_id', '=', 'users.username')
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('timesheet.status', '=', 'Approved')
            ->where('timesheet.user_id', '=', $tutor)
            ->groupBy('timesheet.user_id')
            ->get()->toArray();*/

            ->select(DB::raw("concat(first_name,' ',last_name) as Tutor, users.username as UserID, dayname(date) as Weekday ,date as Date, sum(quantity) as Total"))
            ->join('users', 'timesheet.user_id', '=', 'users.username')
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('timesheet.status', '=', 'Approved')
            ->where('timesheet.user_id', '=', $tutor)
            ->groupBy('timesheet.user_id')
            ->groupBy('timesheet.date')
            ->get()->toArray();

        $data = json_decode(json_encode($data), true);

        Excel::create('HCC_Online_Tutor_Timesheet_Global_Report_' . date("Y-m-d"), function ($excel) use ($data, $date_from, $date_to) {
            $excel->sheet('mySheet', function ($sheet) use ($data, $date_from, $date_to) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('HCC Online Tutoring Services');
                });
                $sheet->cell('A2', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('Tutoring Global Report');
                });
                $sheet->cell('A3', function ($cell) use ($date_from, $date_to) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('From ' . $date_from . ' to ' . $date_to);
                });
                $sheet->cell('A5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('B5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('C5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('D5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->cell('E5', function ($cell) {
                    $cell->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A5', true);
            });
        })->export('xlsx');
    }
}
