<?php

namespace App\Http\Requests;

use App\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'   => [
                'required',
            ],
            'phone'  => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'email'  => [
                'required',
                'unique:clients,email,' . request()->route('client')->id,
            ],
            'gender' => [
                'required',
            ],
        ];
    }
}
