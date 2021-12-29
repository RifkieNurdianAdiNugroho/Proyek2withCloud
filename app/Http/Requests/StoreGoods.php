<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreGoods extends FormRequest
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
        if (Auth::user()->role == 'penjual') {
            return [
                'name' => 'required|string|max:255',
                'category' => 'required',
                'price' => 'required|numeric',
                'description' => '',
            ];
        } else {
            return [
                'user_id' => 'required',
                'name' => 'required|string|max:255',
                'category' => 'required',
                'price' => 'required|numeric',
                'description' => '',
            ];
        }
    }
}
