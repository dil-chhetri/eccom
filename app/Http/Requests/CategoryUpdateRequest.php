<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            // 'category_name' => 'required|unique:categories,category_name,'.$this->id.',category_id', do later
            'image' => 'required',
            'parent_category_entered' => 'required_without:parent_category_selected',
            'parent_category_selected' => 'required_without:parent_category_entered'
        ];
    }
}
