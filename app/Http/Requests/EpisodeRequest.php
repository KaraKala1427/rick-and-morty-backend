<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeRequest extends FormRequest
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
            'sort' => 'nullable|string|in:id,name,season,series,premiere',
            'order' => 'nullable|in:asc,desc',
            'name' => 'nullable|string|max:100',
            'season' => 'nullable|integer|',
            'series' => 'nullable|integer|',
            'premiere' => 'nullable|date|max:100',
            'description' => 'nullable|string|max:10000',
            'image_id' => 'nullable|integer|exists:images,id,deleted_at,NULL',
        ];
    }
}
