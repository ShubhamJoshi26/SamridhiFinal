<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 class AdminController extends Controller
{
   public function LoginAdmin(Request $request)
   {
   
        if($request->userid!='' && $request->password!='')
        {
            $checkuser = DB::table('users')->where('email','=',$request->userid)->where('password','=',md5($request->password))->get();
            $user = $checkuser->toArray();
            if(isset($user) && !empty($user))
            {
                   session()->put(['user_status'=>'logedin','name'=>$user[0]->name,'id'=>$user[0]->id,'email'=>$user[0]->email]);
                   return redirect('/Dashboard')->with('success','Login Successfull');
            }
            else
            {
                return redirect('/Admin')->with('error','Invalid UserId or Password');
            }
        }
   }
}
