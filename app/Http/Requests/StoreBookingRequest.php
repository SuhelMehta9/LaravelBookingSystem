<?php

namespace App\Http\Requests;

use App\Booking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'select_location_id' => [
                'required',
                'integer',
            ],
            'start_date'         => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'start_time'         => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_date'           => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_time'           => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'name'               => [
                'required',
            ],
            'email'              => [
                'required',
            ],
            'phone_number'       => [
                'required',
            ],
            'description'        => [
                'required',
            ],
        ];
    }
}
