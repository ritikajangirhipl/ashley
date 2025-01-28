<?php

namespace App\Http\Requests\ProviderType;

use App\Models\ProviderType;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Get the current provider type's ID from the route
        $providerTypeId = $this->route('providerType')->id ?? null;
    
        if (!$providerTypeId) {
            // Handle the case where the providerType is not passed or is null
            return [];
        }
    
        return [
            'name' => [
                'required',
                'string',
                'max:191',
                'unique:provider_types,name,' . $providerTypeId,  // Exclude the current provider type from the unique check
            ],
            'description' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
            ],
        ];
    }
    
}