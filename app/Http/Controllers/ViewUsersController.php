<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;

class ViewUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $adminUsers=AdminUser::get();

        return view('pages.user-lists', ['page' => 'System User','adminUsers'=>$adminUsers]);
    }
}
