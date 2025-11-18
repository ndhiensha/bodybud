<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'gender' => ['required', 'in:Male,Female'],
            'dob' => ['required', 'date', 'before:today'],
            'weight' => ['nullable', 'numeric', 'min:1', 'max:500'],
            'height' => ['nullable', 'numeric', 'min:1', 'max:300'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->gender = $request->gender;
        $user->date_of_birth = $request->dob;
        $user->weight = $request->weight;
        $user->height = $request->height;
        $user->phone_number = $request->phone;
        $user->address = $request->address;
        $user->save();

        return redirect()->back()
            ->with('success', 'Profile updated successfully!');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Invalid password. Account deletion failed.');
        }

        try {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            $user->delete();

            return redirect()->route('home')
                ->with('success', 'Account deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete account. Please try again.');
        }
    }
}