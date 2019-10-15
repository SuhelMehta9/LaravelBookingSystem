<?php

namespace App\Http\Requests;

use App\WorkingHour;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreWorkingHourRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('working_hour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'workinghours_id'  => [
                'required',
                'integer',
            ],
            'startworkinghour' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'endworkinghour'   => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
        ];
    }
}
