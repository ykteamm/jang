<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenSmenaRequest extends FormRequest
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
            'pharmacy' => 'required',
            'open_code' => 'required|max:10000',
            // 'open_selfi' => 'required|mimes:jpeg,png,jpg|max:10000',
        ];
    }
    public function messages(){

        return  [
          'pharmacy.required' => 'Dorixona tanlamadingiz.',
        //   'open_selfi.required' => 'Selfini tanlamadingiz.',
          'open_code.required' => 'Kun soni yoq.',
          // 'open_selfi.mimes' => 'Faqat rasm tanlang.',
        //   'open_selfi.max' => 'Rasm hajmi 10 megabaytdan oshmasligi lozim',
        ];
      }
}
