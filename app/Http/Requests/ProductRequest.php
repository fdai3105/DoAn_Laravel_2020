<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:10|max:100',
            'desc' => 'required',
            'image' => 'required|url',
            'price' => 'required|numeric',
            'product_brands_id' => 'required',
            'categories_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('product.name_error_required'),
            'name.min' => trans('product.name_error_min'),
            'name.max' => trans('product.name_error_max'),

            'desc.required' => trans('product.desc_error_required'),

            'image.required' => trans('product.img_error_required'),
            'image.url' => trans('product.img_error_url'),

            'price.required' => trans('product.price_error_required'),
            'price.numeric' => trans('product.price_error_numeric'),

            'product_brands_id.required' => trans('product.brand_error_required'),
            'categories_id.required' => trans('product.category_error_required'),
        ];
    }
}
