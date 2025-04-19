<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Update the password for the currently logged-in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        // dd($request);
        // Validate the request data
        $request->validate([
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'new_password.required' => 'The new password is required.',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.confirmed' => 'The new password and confirmation do not match.',
        ]);
        // Get the currently logged-in user
        $user = Auth::user();
        // Update the user's password
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
