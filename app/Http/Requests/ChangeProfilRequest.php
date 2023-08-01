<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProfilRequest extends FormRequest
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
            'nickname' => 'required|max:7',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            // 'close_selfi' => 'required|mimes:jpeg,png,jpg,webp|max:10000',
        ];
    }
    public function messages(){

        return  [
          'nickname.required' => 'Nicknameni kiriting.',
          'nickname.max' => 'Nickname uzunligi 7 belgidan kam bo\'lishi kerak.',
          'phone_number.required' => 'Telefon raqamni kiriting',
        ];
      }
}
