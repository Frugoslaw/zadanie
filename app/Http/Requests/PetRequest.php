<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'sometimes|required|numeric',
            'name' => 'required|string',
            'status' => 'required|string|in:available,pending,sold',
            'photoUrls' => 'required|string',
            'category_name' => 'nullable|string',
            'tags' => 'nullable|string',
        ];
    }
}
