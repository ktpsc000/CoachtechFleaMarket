<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'category_ids' => ['required'],
            'condition' => ['required'],
            'brand' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'description.required' => '商品説明を入力してください',
            'image.required' => '商品画像を選択してください',
            'category.required' => 'カテゴリーを選択してください',
            'condition.required' => '商品状態を選択してください',
            'price.required' => '値段を設定してください',

            'description.max' => '商品説明は255文字以内で入力してください',

            'image.image' => '画像ファイルを選択してください',
            'image.mimes' => '画像はjpgまたはpng形式でアップロードしてください',
            'image.max' => '画像サイズは2MB以内にしてください',

            'price.integer' => '値段は半角数字で入力してください',

            'price.min' => '値段は1円以上で設定してください',
        ];
    }
}
