<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function index(AdminUser $adminUser)
   {

        return view('pages.update-user', ['page' => 'System User','adminUser'=>$adminUser]);
   }

   public function update(AdminUser $adminUser,Request $request)
   {
        if ($adminUser->username==$request->username){
            return back()->with('error', 'No changes made!');
        }

        $this->validate($request,[
            'username'=>'required|min:4|unique:App\Models\AdminUser,username',
        ]);

        $adminUser->username=$request->username;

        $adminUser->save();

        return back()->with('success','Updated admin informaton successfully!');

   }
}
