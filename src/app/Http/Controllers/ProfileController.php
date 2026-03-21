<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show(){
        return view('mypage.show');
    }

    public function edit(Request $request){
        return view('mypage.edit');
    }

    public function update(ProfileRequest $request)
    {
        $user = $request->user();

        $data = $request->only([
            'name',
            'postal_code',
            'address',
            'building',
            'image_path'
        ]);

        $user->profile()->updateOrCreate([], $data);

        $user->update(['profile_completed' => true,]);
        return redirect('/');
    }
}
