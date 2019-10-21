<?php

namespace App\Http\Requests;

use App\Appiontment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAppiontmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('appiontment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'clients.*'   => [
                'integer',
            ],
            'clients'     => [
                'required',
                'array',
            ],
            'employees.*' => [
                'integer',
            ],
            'employees'   => [
                'array',
            ],
            'start_time'  => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'finish_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'services.*'  => [
                'integer',
            ],
            'services'    => [
                'required',
                'array',
            ],
        ];
    }
}
