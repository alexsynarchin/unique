<?php

namespace App\Http\Requests;

use App\Rules\PromoCode;
use Illuminate\Foundation\Http\FormRequest;


class CheckUniqueRequest extends FormRequest
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

            'email' => 'required|email',
            //'plainText' => 'required',
            'symbolsCount' => 'numeric|min:100',
            'promocode' => ['nullable', 'exists:promo_codes,name', new PromoCode()

             ],
            [
                'symbolsCount.min' => 'Количество символов должно быть больше 100',
                'email.required' => 'Введите ваш e-mail',
                'plainText.required' => 'Введите текст для проверки уникальности',
            ]
        ];
    }
}
