<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use App\Models\Category;

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
                    ->latest()
                    ->get();

            } else {
                $items = collect();
            }

        }else {

            $items = Item::with('user','order')
                ->where('items.user_id','!=', auth()->id())
                ->KeywordSearch($keyword)
                ->latest()
                ->get();
        }

        return view('items.index', compact('items', 'tab','keyword'));
    }


    public function show($item_id){
        $item = Item::with('categories','comments.user.profile')
            ->withCount('comments')
            ->withCount('favoriteUsers')
            ->find($item_id);

        return view('items.show', compact('item'));
    }

    public function create(){
        $categories = Category::all();

        return view('items.exhibition', compact('categories'));
    }

    public function store(ExhibitionRequest $request){

        $item = Item::create([
            'user_id' => auth()->id(),
            'image_path' => $request->file('image')->store('items', 'public'),
            'condition' => $request-> condition,
            'name' => $request-> name,
            'brand' => $request-> brand,
            'description' => $request-> description,
            'price' => $request-> price,
        ]);

        $item->categories()->attach($request->category_ids);

        return redirect('/mypage');
    }
}
