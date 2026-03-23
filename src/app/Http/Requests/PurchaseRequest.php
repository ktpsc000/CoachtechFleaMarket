<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function prepareForValidation(){
        $purchase = session('purchase', []);
        $this->merge(['purchase' => $purchase]);
    }

    public function rules()
    {
        return [
            'payment_method' => ['required'],
            'purchase.postal_code' => ['required'],
            'purchase.address' => ['required'],
        ];
    }

        public function messages(){
        return [
            'payment_method.required' => '支払い方法を選択してください',
            'purchase.postal_code.required' => '配送先を入力してください',
            'purchase.address.required' => '配送先を入力してください',
            ];
        }
}