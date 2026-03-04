<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');

        if ($tab === 'mylist') {
            // マイリスト表示処理
        }

        return view('items.index', compact('tab'));
    }

    public function mylist(){
        return view('items.index');
    }

    public function show(Item $item){
        return view('items.show', compact('item'));
    }

    public function create(){
        return view('items.create');
    }

    public function store(){
        return redirect('/');
    }
}
