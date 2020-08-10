<?php


//Home route

Auth::routes();



Route::post('/change-password', 'UsersController@changePassword')->name('changepassword');
Route::get('/forgot-password-view', 'UsersController@forgotPasswordView')->name('forgotpasswordview');
Route::post('/forgot-password', 'UsersController@forgotPassword')->name('forgotpassword');

Route::middleware(['auth'])->group(function () {

    //reset password routes
    Route::get('password/expired', 'Auth\ExpiredPasswordController@expired')->name('password.expired');
    Route::post('password/post_expired', 'Auth\ExpiredPasswordController@postExpired')->name('password.post_expired');
    /////////////////////

    
        Route::middleware(['password_expired'])->group(function () {
            Route::get('/', "AdminHomeController@dashboard")->name('home');
    //Timesheet view routes
    Route::get('/add-tutor-time', 'TimesheetController@addTutorTime')->name('addtutortime');
    Route::get('/pending-approvals', 'TimesheetController@viewPendingApprovals')->name('viewpendingapprovals');
    Route::get('/view-global-time', 'TimesheetController@viewGlobalTime')->name('viewglobaltime');
    Route::get('/view-tutor-time', 'TimesheetController@viewTutorTime')->name('viewtutortime');
    Route::get('/edit-tutor-time', 'TimesheetController@editTutorTime')->name('edittutortime');
    Route::get('/edit-tutor-time2', 'TimesheetController@editTutorTime2')->name('edittutortime2');
    Route::get('/edit-tutor-hours/{id?}', 'TimesheetController@editTutorHours');
    Route::get('/edit-tutor-hours2/{id?}', 'TimesheetController@editTutorHours2');
    Route::get('/generate-global-report', 'TimesheetController@generateGlobalReport')->name('generateglobalreport');
    Route::get('/download-global-report', 'TimesheetController@downloadGlobalReport')->name('downloadglobalreport');
    Route::get('/generate-tutor-report', 'TimesheetController@generateTutorReport')->name('generatetutorreport');
    Route::post('/export-global-report', 'ExportExcelController@downloadExcel')->name('exportglobalreport');
    Route::post('/export-tutor-report', 'ExportExcelController@downloadExcelTutor')->name('exporttutorreport');

    //Timesheet data routes
    Route::get('/pending-approvals-data', 'TimesheetController@listPendingApprovals')->name('listpendingapprovals');
    Route::get('/view-global-time-data', 'TimesheetController@listGlobalTime')->name('viewglobaltimedata');
    Route::post('/save-tutor-time', 'TimesheetController@saveTutorTime')->name('savetutortime');
    Route::post('/deny-time', 'TimesheetController@denyTime')->name('denytime');
    Route::post('/approve-time', 'TimesheetController@approveTime')->name('approvetime');
    Route::post('/view-tutor-time-data', 'TimesheetController@viewTutorTimeData')->name('viewtutortimedata');
    Route::post('/edit-tutor-time-data', 'TimesheetController@editTutorTimeData')->name('edittutortimedata');
    Route::post('/edit-tutor-time-data2', 'TimesheetController@editTutorTimeData2')->name('edittutortimedata2');
    Route::post('/global-report', 'TimesheetController@globalReport')->name('globalreport');



    //Users view routes
    Route::get('/manage-users', 'UsersController@viewUsers')->name('manageusers');
    Route::get('/add-user', 'UsersController@addUser')->name('adduser');
    Route::post('/delete-user', 'UsersController@deleteUser')->name('deleteuser');
    Route::get("/edit-user/{id?}", "UsersController@editUser")->name('editsuser');

    //Users data routes
    Route::get('/manage-users-data', 'UsersController@listUsers')->name('manageusersdata');
    Route::post('/add-user-data', 'UsersController@saveUser')->name('adduserdata');
    Route::post("/edit-user-data", "UsersController@editSaveUser")->name('editsuserdata');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    //TUTOR VIEW---------------------------------------------------------------------------------------------------------------

    //Timesheet view routes
    Route::get('/add-time', 'TimesheetController@addTime')->name('tutoraddtime');
    Route::get('/view-time', 'TimesheetController@viewTime')->name('tutorviewtime');
    Route::get('/generate-report', 'TimesheetController@generateReport')->name('tutorgeneratereport');
    Route::post('/export-report', 'ExportExcelController@tutorDownloadExcel')->name('tutorexportreport');


    //Timesheet data routes
    Route::post('/save-time', 'TimesheetController@saveTime')->name('tutorsavetime');
    Route::post('/view-time-data', 'TimesheetController@viewTimeData')->name('tutorviewtimedata');
    Route::post('/edit-tutor-entry', 'TimesheetController@editTutorEntry')->name('edittutorentry');
    Route::post('/edit-tutor-entry2', 'TimesheetController@editTutorEntry2')->name('edittutorentry2');
    Route::get('/delete-tutor-entry/{id}', 'TimesheetController@deleteTutorEntry');

    //emailing

    Route::get('sendbasicemail','MailController@basic_email');
    Route::get('sendhtmlemail','MailController@html_email');
    Route::get('sendattachmentemail','MailController@attachment_email');
        });
    

});

