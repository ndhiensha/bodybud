<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the profile page
     */
    public function index()
    {
        $user = Auth::user();
        $unreadCount = 0; // Set sesuai dengan notification system kamu
        
        return view('profile', compact('user', 'unreadCount'));
    }

    /**
     * Update the user's profile information
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation rules
        $rules = [
            'gender' => 'nullable|in:male,female',
            'dob' => 'nullable|date|before:today',
            'weight' => 'nullable|numeric|min:1|max:500',
            'height' => 'nullable|numeric|min:1|max:300',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ];

        $messages = [
            'dob.before' => 'Date of birth must be in the past',
            'weight.min' => 'Weight must be greater than 0',
            'weight.max' => 'Weight must be less than 500 kg',
            'height.min' => 'Height must be greater than 0',
            'height.max' => 'Height must be less than 300 cm',
            'profile_picture.image' => 'Profile picture must be an image file',
            'profile_picture.mimes' => 'Profile picture must be a JPEG, PNG, JPG, or GIF file',
            'profile_picture.max' => 'Profile picture must be less than 2MB',
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture if exists
                if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
                    Storage::delete('public/' . $user->profile_picture);
                }

                // Store new profile picture
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $user->profile_picture = $path;
            }

            // Update user data
            $user->gender = $request->input('gender') ?? $user->gender;
            $user->dob = $request->input('dob') ?? $user->dob;
            $user->weight = $request->input('weight') ?? $user->weight;
            $user->height = $request->input('height') ?? $user->height;
            $user->phone = $request->input('phone') ?? $user->phone;
            $user->address = $request->input('address') ?? $user->address;

            $user->save();

            return redirect()->route('profile')->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            return redirect()->route('profile')
                ->with('error', 'Failed to update profile: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile')
                ->with('error', 'Current password is incorrect')
                ->withInput();
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Password updated successfully!');
    }

    /**
     * Delete profile picture
     */
    public function deleteProfilePicture()
    {
        $user = Auth::user();

        if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
            Storage::delete('public/' . $user->profile_picture);
            $user->profile_picture = null;
            $user->save();

            return redirect()->route('profile')
                ->with('success', 'Profile picture deleted successfully!');
        }

        return redirect()->route('profile')
            ->with('error', 'No profile picture to delete');
    }
}