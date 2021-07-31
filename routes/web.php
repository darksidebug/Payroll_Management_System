<?php

use App\Http\Controllers\AddUserController;
use App\Http\Controllers\BlockedEmployeesController;
use App\Http\Controllers\ConfigureSSSchedController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterEmployeeController;
use App\Http\Controllers\UpdateEmployeeController;
use App\Http\Controllers\ResetEmployeePasswordController;
use App\Http\Controllers\DeleteEmployeeController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\ViewEmployeesController;
use App\Http\Controllers\ViewUsersController;
use App\Http\Controllers\DeleteUsersController;
use App\Http\Controllers\DtrController;
use App\Http\Controllers\EmployeeLoginController;
use App\Http\Controllers\LatesController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OnDutyController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ResetUserPasswordController;
use App\Http\Controllers\SetPreferenceController;
use App\Http\Controllers\SetBenifitsController;
use App\Http\Controllers\UploadSSSExcelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaySlipController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\ViewEmployeeCashAdvances;
use App\Http\Controllers\DeleteEmployeeCashAdvances;
use App\Http\Controllers\ServiceChargeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('/', [LoginController::class,'authenticate']);

Route::get('/logout',[LogoutController::class,'logout'])->name('logout');

Route::get('/employee/add-new-employee',[RegisterEmployeeController::class,'index'])->name('register_employee');
Route::post('/employee/add-new-employee',[RegisterEmployeeController::class,'store']);


Route::get('/reset-pass/{adminUser}',[ResetUserPasswordController::class,'reset'])->name('reset_user_password');

Route::get('/employee/view-employee-lists', [ViewEmployeesController::class,'index'])->name('view_employees');


Route::get('/employee/update-employee-info/{employee}',[UpdateEmployeeController::class,'index'])->name('update_employee');
Route::post('/employee/update-employee-info/{employee}',[UpdateEmployeeController::class,'store']);

Route::get('/employee/reset-password/{employee}',[ResetEmployeePasswordController::class,'index'])->name('reset_password');
Route::post('/employee/reset-password/{employee_id}',[ResetEmployeePasswordController::class,'update']);

Route::get('/employee/delete-employee-info/{employee}',[DeleteEmployeeController::class,'index'])->name('delete_employee');
Route::post('/employee/delete-employee-info/{employee_id}',[DeleteEmployeeController::class,'delete']);

Route::get('/user/add-new-system-user',[AddUserController::class,'index'])->name('add_user');
Route::post('/user/add-new-system-user',[AddUserController::class,'store']);

Route::get('/user/view-lists-of-system-user', [ViewUsersController::class,'index'])->name('view_users');

Route::get('/user/delete-system-user/{adminUser}', [DeleteUsersController::class,'index'])->name('delete_user');
Route::post('/user/delete-system-user/{user_id}', [DeleteUsersController::class,'delete']);

Route::get('/user/update-user-account/{adminUser}', [UpdateUserController::class,'index'])->name('update_user');
Route::post('/user/update-user-account/{adminUser}', [UpdateUserController::class,'update']);

Route::get('/set/preferences', [SetPreferenceController::class, 'index'])->name('preference');
Route::post('/set/preferences', [SetPreferenceController::class, 'store']);

Route::get('/view/employee/daily-time-record', [DtrController::class,'index'])->name('dtr');
Route::get('/view/employee/daily-time-record/search/', [DtrController::class,'searchEmpDtr'])->name('dtr.search-employee');

Route::post('/view/employee/daily-time-record/filter/{employee}', [DtrController::class,'filter'])->name('dtr.filter');

Route::get('/set/employee/benefits-deduction', [SetBenifitsController::class, 'index'])->name('benefits');
Route::post('/set/employee/benefits-deduction', [SetBenifitsController::class, 'store']);


Route::get('/view/employee/payrolls', [PayrollController::class,'index'])->name('payroll');
Route::get('view/employee/payrolls/filter/',[PayrollController::class,'filter'])->name('payroll.filter');
Route::post('employee/add/service-charge', [PayrollController::class,'store'])->name('payroll.add_charge');

Route::post('employee/update/service-charge', [ServiceChargeController::class,'store'])->name('update.charge');


Route::get('/employee/login', [EmployeeLoginController::class,'index'])->name('employee_login');
Route::post('/employee/login', [EmployeeLoginController::class,'login']);
Route::post('/employee/confirm',[EmployeeLoginController::class,'confirm'])->name('employee_login.confirm');

Route::get('/employee/lates/today', [LatesController::class,'today'])->name('employee.lates-today');

Route::get('/employee/lates', [LatesController::class,'index'])->name('employee.lates');

Route::get('/employee/on-duty', [OnDutyController::class,'index'])->name('employees.onduty');

Route::get('/upload/file/sss-contribution-schedule', [UploadSSSExcelController::class,'index'])->name('upload');
Route::post('/upload/file/sss-contribution-schedule', [UploadSSSExcelController::class,'uploadExcel']);

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('/configure/sss/schedule', [ConfigureSSSchedController::class,'index'])->name('configure.sss');
Route::get('/configure/sss/schedule/add/', [ConfigureSSSchedController::class,'addRow'])->name('configure.sss.add-row');
Route::post('/configure/sss/schedule', [ConfigureSSSchedController::class,'store']);

Route::get('/employees/blocked',[BlockedEmployeesController::class,'index'])->name('blocked-employees');
Route::post('/employees/blocked/{employee}',[BlockedEmployeesController::class,'unblock'])->name('blocked-employees.unblock');

Route::get('/employees/pay-slips', [PaySlipController::class,'index'])->name('payslip');
Route::get('/employees/pay-slips/filter/', [PaySlipController::class,'filter'])->name('payslip.filter');

Route::get('/cash-advance', [CashAdvanceController::class,'index'])->name('cash_advance');
Route::post('/cash-advance', [CashAdvanceController::class,'store']);

Route::get('/employee/cash-advances-details/{employee}', [ViewEmployeeCashAdvances::class,'index'])->name('cash_advance_details');
Route::post('/employee/delete-cash-advance/{id}', [DeleteEmployeeCashAdvances::class,'delete'])->name('delete_cash_advance_details');
Route::post('/employee/delete-all-cash-advance/{id}', [DeleteEmployeeCashAdvances::class,'deleteAll'])->name('delete_all_cash_advance_details');
Route::post('/employee/reset-all-cash-advance/', [DeleteEmployeeCashAdvances::class,'resetAll'])->name('reset_all_cash_advance_details');


