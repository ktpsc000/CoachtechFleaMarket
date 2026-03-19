<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Item;


class PurchaseController extends Controller
{
    public function create($item_id){
        $item = Item::find($item_id);
        $user = auth()->user();

        $address = session('purchase_address') ?? [
            'postal_code' => optional($user->profile)->postal_code,
            'address' => optional($user->profile)->address,
            'building' => optional($user->profile)->building,

        ];

        return view('items.purchase',compact('item','address'));
    }

    public function editAddress($item_id){
        $item = Item::find($item_id);
        $user = auth()->user();

        $address = session('purchase_address') ?? [
            'postal_code' => optional($user->profile)->postal_code,
            'address' => optional($user->profile)->address,
            'building' => optional($user->profile)->building,
        ];

        return view('address.edit', compact('item','address'));
    }

    public function update(Request $request, $item_id)
    {
        session([
            'purchase_address' => [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
        ]);

        return redirect("/purchase/{$item_id}");
    }
}
