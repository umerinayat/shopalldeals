<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategory extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            'name' => 'required|string',
            'slug' => [
                'required',
                Rule::unique('categories', 'slug')->ignore($this->category),
                'regex:/^[a-zA-Z0-9\s-]+$/',
            ]
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Category name is required.',
            'name.string' => 'Category name must be a string.',
            'slug.required'  => 'Slug is required.',
            'slug.unique'  => $this->slug. ' Slug has already been taken.',
            'slug.regex'  => 'Slug must not have any special characters.',
        ];

        // return [
        //     'name.required' => ':attribute is required',
        //     'name.string' => ':attribute must be a string',
        //     'slug.unique'  => 'This :attribute has already been taken.',
        //     'slug.regex'  => ':attribute must not have any special characters.',
        // ];
    }
}
