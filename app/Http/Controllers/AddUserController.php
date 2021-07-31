<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pages.add-new-user', ['page' => 'System User']);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'username'=>'required|min:4|unique:App\Models\AdminUser,username',
            'password'=>'required|confirmed|min:4',
            'password_confirmation'=>'required'
        ]);

        AdminUser::create([
            'username'=>$request->username,
            'password'=>Hash::make($request->password)
        ]);

        return back()->with('success','New admin was registered successfully!');


    }
}
