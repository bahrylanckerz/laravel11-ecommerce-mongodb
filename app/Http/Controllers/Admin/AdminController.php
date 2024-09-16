<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ], [
                'email.required' => 'Email is required.',
                'email.email' => 'Email is not valid format.',
                'password.required' => 'Password is required.',
            ]);
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (isset($request->remember)) {
                    setcookie('email', $request->email);
                    setcookie('password', $request->password);
                    setcookie('remember', $request->remember);
                } else {
                    setcookie('email', '');
                    setcookie('password', '');
                    setcookie('remember', '');
                }
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('danger', 'Invalid Email or Password!')->withInput();
            }
        }
        return view('admin.login');
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email' => 'required|email',
                'currentPassword' => 'required',
                'newPassword' => 'required',
                'confirmPassword' => 'required',
            ], [
                'email.required' => 'Email is required.',
                'email.email' => 'Email is not valid format.',
                'currentPassword.required' => 'Current Password is required.',
                'newPassword.required' => 'New Password is required.',
                'confirmPassword.required' => 'Confirm Password is required.',
            ]);
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->currentPassword])) {
                if ($request->newPassword == $request->confirmPassword) {
                    $email = Auth::guard('admin')->user()->email;
                    $newPassword = Hash::make($request->newPassword);
                    Admin::where('email', $email)->update(['password' => $newPassword]);
                    return redirect()->back()->with('success', 'Update password has been successfully');
                } else {
                    return redirect()->back()->with('danger', 'New Password and Confirm Password is not matched!')->withInput();
                }
            } else {
                return redirect()->back()->with('danger', 'Invalid Email or Current Password!')->withInput();
            }
        }
        return view('admin.update-password');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
