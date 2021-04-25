<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public
    function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public
    function rules(): array
    {
        if ($this->method() === 'POST')
            return [
                'title'       => 'string|max:191',
                'description' => 'string|min:20'
            ];
        else
            return [
                'title'       => 'string|max:191',
                'description' => 'string|min:1'
            ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public
    function attributes(): array
    {
        return [
            'title'       => 'Title',
            'description' => 'Description',
        ];
    }
}
