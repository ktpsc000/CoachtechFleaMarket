<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $keyword = $request->query('keyword');

        if ($tab === 'mylist'){

            if (auth()->check()) {

                $items = $request->user()->favoriteItems()
                    ->with('user','order')
                    ->where('items.user_id', '!=', auth()->id())
                    ->KeywordSearch($keyword)
                    ->latest()->get();

            } else {
                $items = collect();
            }

        }else {

            $items = Item::with('user','order')
                ->where('items.user_id','!=', auth()->id())
                ->KeywordSearch($keyword)
                ->latest()->get();
        }

        return view('items.index', compact('items', 'tab','keyword'));
    }


    public function show($item_id){
        $item = Item::find($item_id);
        return view('items.show', compact('item'));
    }

    public function create(){
        return view('items.create');
    }

    public function store(){
        return redirect('/');
    }
}
