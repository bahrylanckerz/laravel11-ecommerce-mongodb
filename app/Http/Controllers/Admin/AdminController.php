<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('menu', 'dashboard');
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ], [
                'email.required'    => 'Email is required.',
                'email.email'       => 'Email is not valid format.',
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
        Session::put('menu', 'admin-management');
        Session::put('page', 'update-password');
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email'           => 'required|email',
                'currentPassword' => 'required',
                'newPassword'     => 'required',
                'confirmPassword' => 'required',
            ], [
                'email.required'           => 'Email is required.',
                'email.email'              => 'Email is not valid format.',
                'currentPassword.required' => 'Current Password is required.',
                'newPassword.required'     => 'New Password is required.',
                'confirmPassword.required' => 'Confirm Password is required.',
            ]);
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->currentPassword])) {
                if ($request->newPassword == $request->confirmPassword) {
                    $email = $request->email;
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

    public function editProfile(Request $request)
    {
        Session::put('menu', 'admin-management');
        Session::put('page', 'edit-profile');
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email' => 'required|email',
                'name'  => 'required',
                'phone' => 'required|numeric',
            ], [
                'email.required' => 'Email is required.',
                'email.email'    => 'Email is not valid format.',
                'name.required'  => 'Full Name is required.',
                'phone.required' => 'Phone is required.',
                'phone.numeric'  => 'Phone must be number.',
            ]);
            $email = Auth::guard('admin')->user()->email;
            $data = [
                'name'  => $request->name,
                'phone' => $request->phone,
            ];
            if ($request->hasFile('image')) {
                $tmpImage = $request->file('image');
                if ($tmpImage->isValid()) {
                    $path      = 'admin/img/profile/';
                    $extImage  = $tmpImage->getClientOriginalExtension();
                    $filename  = time().$extImage;
                    $pathImage = $path.$filename;
                    Image::make($tmpImage)->save($pathImage);
                    $oldImage = $path.Auth::guard('admin')->user()->image;
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
                $data['image'] = $filename;
            }
            Admin::where('email', $email)->update($data);
            return redirect()->back()->with('success', 'Edit profile has been successfully');
        }
        return view('admin.edit-profile');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
