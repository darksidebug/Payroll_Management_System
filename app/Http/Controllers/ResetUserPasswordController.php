<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetUserPasswordController extends Controller
{
    protected $defaultPass='1234';
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function reset(AdminUser $adminUser)
    {
        $isSameUser=$adminUser->username===Auth::user()->username;
        
    
       $adminUser->password=Hash::make($this->defaultPass);
       $adminUser->save();

       if($isSameUser){
              return redirect(route('login'))->with('password-reset-success','Reset password successful. Please log back in.');  
        }else{
            return back()->with('success','Password reset successful!');
        }
      

    }
}
