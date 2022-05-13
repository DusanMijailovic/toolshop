<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateToolRequest extends FormRequest
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
            'name'=>'required' ,
            'description' => 'required',
            'price' => 'required|min:1|numeric',
            'sitePrice' => 'required|min:1|numeric',
            'imgSrc'=>'nullable|image|max:8000',
            'categoryId'=>'exists:category,categoryID',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Name is required",
            "description.required" => "Description is required",
            "price.required" => "Price is required",
            "sitePrice.required" => "Price is required",
            "price.numeric" => "Price must be numeric value",
            "sitePrice.numeric" => "Price must be numeric value",
            "imgSrc.image" => "File must be image format",
            "imgSrc.max" => "Image size is 8000kb maximum",
            'categoryId.exists' => 'You must choose category.'

        ];
    }
}
