<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class PurchaseController extends Controller
{
    public function create($item_id){
        $item = Item::find($item_id);
        $user = auth()->user();

        if (!$user->profile_completed) {
            return redirect('/mypage/profile');
        }

        $default = [
            'payment_method' => 'コンビニ払い',
            'postal_code' => $user->profile->postal_code,
            'address' => $user->profile->address,
            'building' => optional($user->profile)->building,
        ];

        $purchase = array_merge($default, session('purchase', []));

        session()->put('purchase', $purchase);

        return view('items.purchase',compact('item','purchase'));
    }

    public function editAddress($item_id){
        $item = Item::find($item_id);
        $user = auth()->user();

        $default = [
            'postal_code' => $user->profile->postal_code,
            'address' => $user->profile->address,
            'building' => optional($user->profile)->building,
        ];

        $purchase = array_merge($default, session('purchase', []));

        return view('address.edit', compact('item','purchase'));
    }

    public function update(AddressRequest $request, $item_id){
        $purchase = session('purchase', []);

        $purchase['postal_code'] = $request->postal_code;
        $purchase['address'] = $request->address;
        $purchase['building'] = $request->building;

        session()->put('purchase', $purchase);

        return redirect("/purchase/{$item_id}");
    }

    public function store(PurchaseRequest $request, $item_id){
        $item = Item::find($item_id);

        if ($item->isSold()) {
            return redirect("/purchase/{$item_id}");
        }

        $purchase = session('purchase',[]);
        $purchase['payment_method'] = $request->payment_method;
        session()->put('purchase', $purchase);

        if($request->payment_method === 'カード払い'){
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' =>[
                        'currency' => 'jpy',
                        'product_data' => ['name' => $item->name,],
                        'unit_amount' => $item->price,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => url("/purchase/success/{$item->id}"),
                'cancel_url' => url("/purchase/{$item->id}"),
            ]);

            return redirect($session->url);

        }

        return $this->createOrder($item_id);
    }

    public function success($item_id)
    {
        return $this->createOrder($item_id);
    }

    public function createOrder($item_id)
    {
        $item = Item::find($item_id);
        $user = auth()->user();
        $purchase = session('purchase', []);

        Order::create([
            'item_id' => $item->id,
            'buyer_id' => $user->id,
            'seller_id' => $item->user_id,
            'price' => $item->price,
            'payment_method' => $purchase['payment_method'],
            'postal_code' => $purchase['postal_code'],
            'address' => $purchase['address'],
            'building' => $purchase['building'],
        ]);

        session()->forget('purchase');

        return redirect('/');
    }

}
