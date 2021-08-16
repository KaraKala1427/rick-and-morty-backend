<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'status' => 'required|string|in:alive,dead',
            'gender' => 'required|string|in:male,female',
            'race' => 'required|string|in:human,alien,robot,humanoid,animal',
            'description' => 'required|string|max:10000',
        ];
    }
}
