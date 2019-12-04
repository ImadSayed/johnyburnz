<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($user)
    {
        $user = User::findOrFail($user);

        return view('private.profile.show', [
            'user' => $user,
        ]);
    }

    public function edit(\App\User $user)
    {
        $this->authorize('update', $user->profile);
        //since we user \App\User $user in brackets above so we dont need to use User::find($user);
        return view('private.profile.edit', compact('user'));//compact sends a variable $user assigned to user
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $userData = request()->validate([
            'name' => 'required',
            'username' => 'required',
        ]);
        $profileData = request()->validate([
            'title' => 'required',
            'instrument' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);



        if(request('image')) {

            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->resize(1000, 1000);//->fit(1000,1000);
            $image->save();
        }

        auth()->user()->update($userData);

        //merge prev array with array containing new data
        auth()->user()->profile->update(array_merge(
            $profileData,
            ['image' => $imagePath]
        ));

        return redirect("/profile/show/{$user->id}");
    }
}
