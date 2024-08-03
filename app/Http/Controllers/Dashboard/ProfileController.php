<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        
        return view('dashboard.profiles.edit', [
            'user' => Auth::user()->profile
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:50'],
            'last_name' => ['required', 'string', 'min:3', 'max:50'],
            'gender' => ['nullable', 'in:male,female'],
            'birthday' => ['nullable', 'before:today']
        ]);

        $user = Auth::user();
        // if user exists update profile else create new profile for this user
        $user->profile->fill($request->all())->save();

        flash()->success('saved successfully');
        return redirect()->back();
    }
}
