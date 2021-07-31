<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeleteUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(AdminUser $adminUser)
    {
        return view('pages.user-confirm-delete', ['page' => 'System User','adminUser'=>$adminUser]);
    }

    public function delete($user_id)
    {
        $employee = AdminUser::findOrFail($user_id);
        $employee->delete();

        return redirect('/user/view-lists-of-system-user')->with('status',"User account deleted successfully");;
    }
}