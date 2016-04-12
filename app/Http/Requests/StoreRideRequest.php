<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreRideRequest extends Request
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
            'title'             => 'required',
            'seats_available'   => 'required|numeric',
            'departure_city'    => 'required|alpha',
            'departure_state'   => 'required',
            'departure_date'    => 'required',
            'departure_time'    => 'required',
            'arrival_city'      => 'required|alpha',
            'arrival_state'     => 'required',
            'message'           => 'required'
        ];
    }
}
