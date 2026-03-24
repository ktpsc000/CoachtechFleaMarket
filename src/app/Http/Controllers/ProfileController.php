<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\Item;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = auth()->user();
        $tab = $request->query('tab');
        $profile = $user->profile;

        if($tab !== 'purchased'){
        $items = Item::where('user_id', $user->id)
            ->with('order')
            ->latest()
            ->get();

        }else{
            $items = Item::whereHas('order', function ($query) use ($user) {
                $query->where('buyer_id', $user->id);
            })
            ->with('order')
            ->latest()
            ->get();
        }

        return view('mypage.show', compact('items','tab','profile'));
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
