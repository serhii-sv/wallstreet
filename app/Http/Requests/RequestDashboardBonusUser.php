<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RequestDashboardBonusUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency_id' => ['required'],
            'payment_system_id' => ['required'],
            'user'   => ['required'],
            'amount'    => ['required'],
        ];
    }
    
    public function messages()
    {
        return [
            'currency_id.required' => __('Currency is required'),
            'payment_system_id.required' => __('Payment system is required'),
            'user.required'   => __('User must be selected'),
            'amount.required'    => __('Amount is required'),
        ];
    }
}
