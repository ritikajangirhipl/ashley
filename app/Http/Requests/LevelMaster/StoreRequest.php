<?php

namespace App\Http\Requests\LevelMaster;

use App\Models\LevelMaster;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('level_master_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title'     => 'required|unique:level_masters,title|numeric|integer|min:0',
        ];

    }
}
