<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('admins.auth.login');
    }
    public function submit_login(Request $request){
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ],
            [
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.max' => 'Mật khẩu không được vượt quá 30 ký tự.',
            ],
        );

        $credentials = ([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if(Auth::attempt($credentials)){
            return redirect()->route('admin.home')->with([
                'success'=>'đăng nhập thành công'
            ]);
        }
        else{
            return redirect()->route('admin.login')->with([
                'error'=>'sai thông tin đăng nhập'
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with(['success' => 'Bạn đã đăng xuất thành công!']);
    }
}
