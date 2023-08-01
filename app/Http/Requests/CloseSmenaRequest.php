<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CloseSmenaRequest extends FormRequest
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
            'close_selfi' => 'required|max:10000',
            // 'close_selfi' => 'required|mimes:jpeg,png,jpg,webp|max:10000',
        ];
    }
    public function messages(){

        return  [
          'close_selfi.required' => 'Selfini tanlamadingiz.',
        //   'close_selfi.mimes' => 'Faqat rasm tanlang.',
          'close_selfi.max' => 'Rasm hajmi 10 megabaytdan oshmasligi lozim',
        ];
      }
}
