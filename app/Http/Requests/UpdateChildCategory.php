<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChildCategory extends FormRequest
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
                Rule::unique('child_categories', 'slug')->ignore($this->child_category),
                'regex:/^[a-zA-Z0-9\s-]+$/',
            ],
            'sub_category_id' => 'required|integer',
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
            'sub_category_id.required' => 'Sub Category is required.',
            'name.required' => 'Category name is required.',
            'name.string' => 'Category name must be a string.',
            'slug.required'  => 'Slug is required.',
            'slug.unique'  => $this->slug.' slug has already been taken.',
            'slug.regex'  => 'Slug must not have any special characters.',
        ];
    }
}
