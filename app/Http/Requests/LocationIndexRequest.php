<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationIndexRequest extends FormRequest
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
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer',
            'sort' => 'nullable|string|in:id,name,status,gender,race',
            'order' => 'nullable|in:asc,desc',
            'type.*' => 'nullable|string|in:universe,planet,sector,base,microverse',
            'dimension.*' => 'nullable|string|in:c-137,replaced,5-126',
            'name' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:10000',
            'image_id' => 'nullable|integer|exists:images,id,deleted_at,NULL',
        ];
    }
}
