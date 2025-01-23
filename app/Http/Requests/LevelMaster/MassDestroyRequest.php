<?php

namespace App\Http\Requests\LevelMaster;

use App\Models\LevelMaster;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('level_master_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:level_masters,id',
        ];

    }
}
