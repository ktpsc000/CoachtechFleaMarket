<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\Item;


class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = auth()->user();
        $page = $request->query('page');
        $profile = $user->profile;

        if (!$user->profile) {
            return redirect('/mypage/profile');
        }

        if($page !== 'buy'){
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

        return view('mypage.show', compact('items','page','profile'));
    }

    public function edit(Request $request){
        $user = $request->user();
        $profile = $user->profile ?? new Profile();

        return view('mypage.edit',compact('profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = $request->user();
        $data = $request->only([
            'name',
            'postal_code',
            'address',
            'building',
        ]);

        if ($request->hasFile('image')) {

            if ($user->profile?->image_path) {
                Storage::disk('public')->delete($user->profile->image_path);
            }

            $path = $request->file('image')->store('profiles', 'public');
            $data['image_path'] = $path;
        }

        $user->profile()->updateOrCreate([], $data);
        $user->update(['profile_completed' => true,]);

        return redirect('/');
    }
}
