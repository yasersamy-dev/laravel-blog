<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // صفحة تسجيل الدخول
    public function showLogin()
{
    if (auth()->check()) {
        return redirect()->route('posts.index');
    }
    return view('auth.login');
}

   public function login(Request $request)
  {
    $request->validate([
        'email'=> 'required|email',
        'password'=> 'required|min:3|max:25',
    ]);

     $credentials = $request->only('email','password');

    if (Auth::attempt($credentials)) {
        // تسجيل الدخول ناجح
        return redirect()->intended('/posts');
    }

    return back()->withErrors([
        'email' => 'بيانات الدخول غير صحيحة',
    ]);
 }


    // صفحة إنشاء حساب جديد
    public function showRegister()
    {
        return view('auth.register');
    }
    public function store(Request $request){
        $request ->validate([
            'name' => 'required|string|max:250',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('login')->with('success', 'تم إنشاء الحساب بنجاح، يمكنك تسجيل الدخول الآن');
    }
    public function logout(Request $request)
{
     Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}

}


