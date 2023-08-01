<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KingSoldRequest extends FormRequest
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
            // 'image' => 'required|max:10000',
            // 'image' => 'required|mimes:jpeg,png,jpg,webp|max:10000',
        ];
    }
    public function messages(){

        return  [
          'image.required' => 'Chekni rasmga olmadingiz.',
        //   'image.mimes' => 'Faqat rasm tanlang.',
          'image.max' => 'Rasm hajmi 10 megabaytdan oshmasligi lozim',
        ];
      }
}
