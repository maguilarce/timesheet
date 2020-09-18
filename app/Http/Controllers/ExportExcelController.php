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


        //Global Time sheet query builer
        $data = DB::table('timesheet')
            ->select(DB::raw("concat(last_name,', ',first_name) as Tutor, dayname(date) as Weekday ,date as Date, sum(quantity) as Total"))
            ->join('users', 'timesheet.user_id', '=', 'users.username')
            ->where('date', '>=', $date_from_formatted)
            ->where('date', '<=', $date_to_formatted)
            ->where('timesheet.status', '=', 'Approved')
            ->groupBy('timesheet.user_id')
            ->groupBy('timesheet.date')
            ->orderBy('Tutor', 'asc')
            ->orderBy('date', 'asc')
            ->get()->toArray();
        $data_count = count($data);
        $data = json_decode(json_encode($data), true);
        

        //Individual Totals sheet for query builder
        $data2 = DB::table('timesheet')
        ->select(DB::raw("concat(last_name,', ',first_name) as Tutor,  sum(quantity) as Total"))
        ->join('users', 'timesheet.user_id', '=', 'users.username')
        ->where('date', '>=', $date_from_formatted)
        ->where('date', '<=', $date_to_formatted)
        ->where('timesheet.status', '=', 'Approved')
        ->groupBy('timesheet.user_id')
        ->orderBy('Tutor', 'asc')
        
        ->get()->toArray();
        $data_count2 = count($data2);

    $data2 = json_decode(json_encode($data2), true);

        Excel::create('HCC_Online_Tutor_Timesheet_Global_Report_' . date("Y-m-d"), function ($excel) use ($data,$data_count,$data2,$data_count2, $date_from, $date_to) {
            //Global Time sheet
            $excel->sheet('Global Time', function ($sheet) use ($data, $date_from, $date_to,$data_count,$data_count2) {
                $sheet->setFontSize('16');
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
             
                
                $sheet->fromArray($data, null, 'A5', true);


                
                for($i=1;$i<=$data_count;$i++)
                {
                    $sheet->cell('A'.strval($i+5), function($cell) use ($data_count){
                        $cell->setBorder('thin','thin','thin','thin');
                    });
                    $sheet->cell('B'.strval($i+5), function($cell) use ($data_count){
                        $cell->setBorder('thin','thin','thin','thin');
                    });
                    $sheet->cell('C'.strval($i+5), function($cell) use ($data_count){
                        $cell->setBorder('thin','thin','thin','thin');
                    });
                    $sheet->cell('D'.strval($i+5), function($cell) use ($data_count){
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                }
                
            });

            //Individual Totals sheet
            $excel->sheet('Individual Totals', function ($sheet) use ($data2, $date_from, $date_to,$data_count,$data_count2) {
                $sheet->setFontSize('15');
                $sheet->cell('A1', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('HCC Online Tutoring Services');
                });
                $sheet->cell('A2', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('Individual total of hours by tutor');
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

                //$sheet->setBorder('A5:C'.$data_count2);
                
                $sheet->fromArray($data2, null, 'A5', true);

                for($i=1;$i<=$data_count2;$i++)
                {
                    $sheet->cell('A'.strval($i+5), function($cell) use ($data_count2){
                        $cell->setBorder('thin','thin','thin','thin');
                    });
                    $sheet->cell('B'.strval($i+5), function($cell) use ($data_count2){
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                }
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
            //->orderBy('timesheet.date', 'asc')
            
            ->get()->toArray();

        $data = json_decode(json_encode($data), true);

        

        Excel::create('HCC_Online_Tutor_Timesheet_Individual_Report_' . date("Y-m-d"), function ($excel) use ($data, $date_from, $date_to) {
            $excel->sheet('Global Time', function ($sheet) use ($data, $date_from, $date_to) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('HCC Online Tutoring Services');
                });
                $sheet->cell('A2', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('Tutoring Individual Report');
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

        Excel::create('HCC_Online_Tutor_Timesheet_Individual_Report_' . date("Y-m-d"), function ($excel) use ($data, $date_from, $date_to) {
            $excel->sheet('mySheet', function ($sheet) use ($data, $date_from, $date_to) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('HCC Online Tutoring Services');
                });
                $sheet->cell('A2', function ($cell) {
                    $cell->setFontWeight('bold');
                    $cell->setValue('Tutoring Individual Report');
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
