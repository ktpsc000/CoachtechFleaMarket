<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class FavoriteController extends Controller
{
    public function toggle(Item $item)
    {
        $user = auth()->user();

        if ($user->favoriteItems()->where('item_id', $item->id) ->exists()){
            $user->favoriteItems()->detach($item->id);
        } else {
            $user->favoriteItems()->attach($item->id);
        }

        return back();
    }
}
