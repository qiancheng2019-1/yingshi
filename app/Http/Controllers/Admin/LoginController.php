<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /*
     * 登录
     * */
    public function login(){
//        dd(Auth::check());
        if(Auth::check()){
            return redirect(route('admin.index'));
        }
        return view('admin.login.login');
    }
    /*
     * 管理员登录
     * */
    public function dologin(Request $request){
        $validatedData = $request->validate([
            'captcha' => 'required|captcha',
        ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);
       $result = Auth::guard('admin')->attempt([
            'username'=>$request->username,
            'password'=>$request->password,
            ]);
//        dump(Auth::user());
//        dump(Auth::id());
//        dd($result);
//       dd(Auth::user());
       if ($result){
           if(Auth::user()->status ==1){
               $request->session()->flash('errormsg','账号状态异常');
               Auth::logout();
               return redirect()->back();
           }
            return redirect(route('admin.index'));
       }else{
           $request->session()->flash('errormsg','账号或密码错误');
           return redirect()->back();
       }
    }
    /*
     * 退出登录
     * */
    public function logout(){
        Auth::logout();
        return redirect(route('admin.login.login'));
    }
}
