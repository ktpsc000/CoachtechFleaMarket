<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'string','max:255'],
            'building' => ['nullable','string','max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'postal_code.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',

            'name.max' => 'お名前は20文字以内で入力してください',
            'address.max' => '住所は255文字以内で入力してください',
            'building.max' => '建物名は255文字以内で入力してください',


            'postal_code.regex' => '郵便番号は「123-4567」の形式で入力してください',

            'image.image' => '画像ファイルを選択してください',
            'image.mimes' => '画像はjpgまたはpng形式でアップロードしてください',
            'image.max' => '画像サイズは2MB以内にしてください',

        ];
    }


}
