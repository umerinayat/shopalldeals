<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDeal extends FormRequest
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
            'link_to_deal' => 'required',
            'title' => 'required',
            'slug' => [
                'required',
                Rule::unique('deals', 'slug')->ignore($this->deal),
                'regex:/^[a-zA-Z0-9\s-]+$/',
            ],
            'description' => 'required',
            'category_id' => 'required',
            'store_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'slug.required'  => 'Slug is required.',
            'slug.unique'  => $this->slug .' slug has already been taken.',
            'slug.regex'  => 'Slug must not have any special characters.',
        ];
    }
}
