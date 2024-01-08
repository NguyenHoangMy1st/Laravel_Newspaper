<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminArticleRequest extends FormRequest
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

    public function rules()
    {
        return [
            'a_name'        => 'required',
            'a_content'     => 'required',
            'a_menu_id'     => 'required',
            'a_description' => 'required|max:180',
            'a_slug'        => 'required|unique:articles,a_slug,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'a_menu_id.required'     => 'Dữ liệu không được để trống',
            'a_name.required'        => 'Dữ liệu không được để trống',
            'a_content.required'     => 'Dữ liệu không được để trống',
            'a_description.required' => 'Dữ liệu không được để trống',
            'a_description.max'      => 'Dữ liệu không quá 180 ký tự',
            'a_slug.required'        => 'Dữ liệu không được để trống',
            'a_slug.unique'          => 'Slug đã tồn tại',
        ];
    }
}
