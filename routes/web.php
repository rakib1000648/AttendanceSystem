<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\EmployeePositionController;
use App\Http\Controllers\AttendanceMonthlyController;
use App\Http\Controllers\DepartmentSectionController;
use App\Http\Controllers\Reports\DailyLeaveController;
use App\Http\Controllers\Reports\MonthlyLeaveController;
use App\Http\Controllers\Reports\DailyMissPunchController;
use App\Http\Controllers\Reports\DailyAttendanceController;
use App\Http\Controllers\Reports\DailyEarlyLeaveController;
use App\Http\Controllers\Reports\DailyLateSummeryController;
use App\Http\Controllers\Reports\MonthlyMissPunchController;
use App\Http\Controllers\Reports\MonthlyEarlyLeaveController;
use App\Http\Controllers\Reports\ShiftWiseEmployeeController;
use App\Http\Controllers\Reports\DailyAbsentSummeryController;
use App\Http\Controllers\Reports\MonthlyLateSummeryController;
use App\Http\Controllers\Reports\DailyPresentSummeryController;
use App\Http\Controllers\Reports\MonthlyAbsentSummeryController;
use App\Http\Controllers\Reports\MonthlyPresentSummeryController;
use App\Http\Controllers\Reports\MonthlyAttendanceDptDsgController;
use App\Http\Controllers\Reports\MonthlyAttendanceHistoryController;
use App\Http\Controllers\Reports\MonthlyAttendanceShiftWiseController;

Route::get('/login', function () {
    return view('auth.login');
});


Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::redirect('/dashboard','/home', 301);


    Route::get('/att-list/{branch_id?}/{year?}/{month?}/{day?}/{id?}/{type?}', [AttendanceController::class, 'index']);
    Route::get('/att-list-monthly/{branch_id?}/{year?}/{month?}/{id?}/{type?}', [AttendanceMonthlyController::class, 'index']);


    Route::get('generate-pdf', [AttendanceController::class, 'generatePDF']);
    Route::get('generate-att-monthly-pdf', [AttendanceMonthlyController::class, 'generatePDF']);

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::controller(DesignationController::class)->group(function () {
        Route::get('/designations', 'index');
        Route::get('/create-designation', 'createDesignation');
        Route::post('/create-designation', 'addDesignation');
        Route::get('/edit-designation/{id}', 'editDesignation');
        Route::put('/edit-designation', 'updateDesignation');
    });

    Route::controller(BranchController::class)->group(function () {
        Route::get('/branches', 'index');
        Route::get('/create-branch', 'createBranch');
        Route::post('/create-branch', 'addBranch');
        Route::get('/edit-branch/{id}', 'editBranch');
        Route::put('/edit-branch', 'updateBranch');
    });

    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index');
        Route::get('/create-department', 'createDepartment');
        Route::post('/create-department', 'addDepartment');
        Route::get('/edit-department/{id}', 'editDepartment');
        Route::put('/edit-department', 'updateDepartment');
    });

    Route::controller(DepartmentSectionController::class)->group(function () {
        Route::get('/department-sections', 'index');
        Route::get('/create-department-section', 'createDepartmentSection');
        Route::post('/create-department-section', 'addDepartmentSection');
        Route::get('/edit-department-section/{id}', 'editDepartmentSection');
        Route::put('/edit-department-section', 'updateDepartmentSection');
    });

    Route::controller(ShiftController::class)->group(function () {
        Route::get('/shifts', 'index');
        Route::get('/create-shift', 'createShift');
        Route::post('/create-shift', 'addShift');
        Route::get('/edit-shift/{id}', 'editShift');
        Route::put('/edit-shift', 'updateShift');
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index');
        Route::get('/view-employee/{id}', 'viewEmployee');
        Route::get('/create-employee', 'createEmployee');
        Route::post('/create-employee', 'addEmployee');
        Route::get('/edit-employee/{id}', 'editEmployee');
        Route::put('/edit-employee', 'updateEmployee');

        Route::get('/download-nid/{id}', 'downloadEmployeeNid');
        Route::get('/download-bc/{id}', 'downloadEmployeeBc');

    });

    Route::controller(EmployeeTypeController::class)->group(function () {
        Route::get('/employee-types', 'index');
        Route::get('/view-employee-type/{id}', 'viewEmployeeType');
        Route::get('/create-employee-type', 'createEmployeeType');
        Route::post('/create-employee-type', 'addEmployeeType');
        Route::get('/edit-employee-type/{id}', 'editEmployeeType');
        Route::put('/edit-employee-type', 'updateEmployeeType');
        Route::get('/delete-employee-type/{id}', 'deleteEmployeeType');
    });

    Route::controller(EmployeePositionController::class)->group(function () {
        Route::get('/employee-positions', 'index');
        Route::get('/view-employee-position/{id}', 'viewEmployeePosition');
        Route::get('/create-employee-position', 'createEmployeePosition');
        Route::post('/create-employee-position', 'addEmployeePosition');
        Route::get('/edit-employee-position/{id}', 'editEmployeePosition');
        Route::put('/edit-employee-position', 'updateEmployeePosition');
        Route::get('/delete-employee-position/{id}', 'deleteEmployeePosition');
    });

    Route::controller(HolidayController::class)->group(function () {
        Route::get('/holidays', 'index');
        Route::get('/view-holiday/{id}', 'viewHoliday');
        Route::get('/create-holiday', 'createHoliday');
        Route::post('/create-holiday', 'addHoliday');
        Route::get('/edit-holiday/{id}', 'editHoliday');
        Route::put('/edit-holiday', 'updateHoliday');
        Route::get('/delete-holiday/{id}', 'deleteHoliday');
    });

    Route::controller(EmployeeLeaveController::class)->group(function () {
        Route::get('/leaves', 'index');
        Route::get('/leaves-yearly/{branch_id?}/{year?}', 'monthlyLeaveReport');
        Route::get('/generate-leave-report-pdf', 'generateLeaveReportPDF');
        Route::get('/view-leave/{id}', 'viewEmployeeLeave');
        Route::get('/create-leave', 'createEmployeeLeave');
        Route::post('/create-leave', 'addEmployeeLeave');
        Route::get('/edit-leave/{id}', 'editEmployeeLeave');
        Route::put('/edit-leave', 'updateEmployeeLeave');
        Route::get('/delete-leave/{id}', 'deleteEmployeeLeave');
        Route::get('/approve-leave/{id}', 'approveEmployeeLeave');
        Route::get('/reject-leave/{id}', 'rejectEmployeeLeave');
    });


    //=======================================================================================================


    Route::get('employee-shift-wise/{shift?}', [ShiftWiseEmployeeController::class, 'index']);
    
    Route::get('daily-attendance-summary', [DailyAttendanceController::class, 'index']);
    Route::post('daily-attendance-summary', [DailyAttendanceController::class, 'DateWise']);
    Route::get('daily-attendance-summary-pdf', [DailyAttendanceController::class, 'generatePDF']);

    Route::get('daily-present-summary', [DailyPresentSummeryController::class, 'index']);
    Route::post('daily-present-summary', [DailyPresentSummeryController::class, 'DateWise']);
    Route::get('daily-present-summary-pdf', [DailyPresentSummeryController::class, 'generatePDF']);

    Route::get('daily-absent-summary', [DailyAbsentSummeryController::class, 'index']);
    Route::post('daily-absent-summary', [DailyAbsentSummeryController::class, 'DateWise']);
    Route::get('daily-absent-summary-pdf', [DailyAbsentSummeryController::class, 'generatePDF']);

    Route::get('daily-late-summary', [DailyLateSummeryController::class, 'index']);
    Route::post('daily-late-summary', [DailyLateSummeryController::class, 'DateWise']);
    Route::get('daily-late-summary-pdf', [DailyLateSummeryController::class, 'generatePDF']);

    Route::get('daily-miss-punch', [DailyMissPunchController::class, 'index']);
    Route::post('daily-miss-punch', [DailyMissPunchController::class, 'DateWise']);
    Route::get('daily-miss-punch-pdf', [DailyMissPunchController::class, 'generatePDF']);


    Route::get('daily-leave', [DailyLeaveController::class, 'index']);
    Route::post('daily-leave', [DailyLeaveController::class, 'dateWise']);
    Route::get('daily-leave-pdf', [DailyLeaveController::class, 'generatePDF']);

    Route::get('daily-early-leave', [DailyEarlyLeaveController::class, 'index']);    


    Route::get('monthly-attendance-punches', [MonthlyAttendanceShiftWiseController::class, 'index']);
    Route::get('monthly-punch-records/{id}', [MonthlyAttendanceShiftWiseController::class, 'punchReacord']);
    Route::post('monthly-punch-records', [MonthlyAttendanceShiftWiseController::class, 'dateWise']);
    Route::get('monthly-punch-records-pdf', [MonthlyAttendanceShiftWiseController::class, 'generatePDF']);




    


    Route::get('monthly-absent-summary', [MonthlyAbsentSummeryController::class, 'index']);
    Route::get('monthly-present-summary', [MonthlyPresentSummeryController::class, 'index']);

    Route::get('monthly-attendance-history', [MonthlyAttendanceHistoryController::class, 'index']);
    Route::post('monthly-attendance-history', [MonthlyAttendanceHistoryController::class, 'getHistory']);
    
    Route::get('monthly-attendance-dept-dsgn', [MonthlyAttendanceDptDsgController::class, 'index']);
    Route::get('monthly-early-leave', [MonthlyEarlyLeaveController::class, 'index']);
    Route::get('monthly-late-summary', [MonthlyLateSummeryController::class, 'index']);
    Route::get('monthly-leave', [MonthlyLeaveController::class, 'index']);
    Route::get('monthly-miss-punch', [MonthlyMissPunchController::class, 'index']);


});
