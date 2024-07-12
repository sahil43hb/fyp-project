<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }
    public function changePassword(Request $request)
    {
        // Retrieve the current password and new password from the request
        $currentPassword = $request->input('password');
        $newPassword = $request->input('newpassword');
        // Retrieve the authenticated user
        $user = Auth::user();
        // Check if the current password matches the user's stored password
        if (Hash::check($currentPassword, $user->password)) {
            // Provided current password matches, proceed with updating the password
            $user->password = Hash::make($newPassword);
            $user->save();
            return redirect()->back()->with('success', "Password Updated Successfully");
        } else {
            // Current password is incorrect, return error response
            return redirect()->back()->with('error', "Something went wrong.Please try again!");
        }
    }
}
