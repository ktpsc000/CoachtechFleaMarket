<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class FavoriteController extends Controller
{
    public function toggle($item_id)
    {
        auth()->user()->favoriteItems()->toggle($item_id);
        return back();
    }
}
