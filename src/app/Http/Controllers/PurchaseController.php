<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Item;


class PurchaseController extends Controller
{
    public function create($item_id){
        $item = Item::find($item_id);
        $user = auth()->user();

        $address = session('purchase_address') ?? [
            'postal_code' =>$user->profile->postal_code,
            'address' =>$user->profile->address,
            'building' => optional($user->profile)->building,
        ];

        return view('items.purchase',compact('item','address'));
    }

    public function editAddress($item_id){
        $item = Item::find($item_id);
        $user = auth()->user();

        $address = session('purchase_address') ?? [
            'postal_code' => $user->profile->postal_code,
            'address' => $user->profile->address,
            'building' => optional($user->profile)->building,
        ];

        return view('address.edit', compact('item','address'));
    }

    public function update(AddressRequest $request, $item_id)
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
