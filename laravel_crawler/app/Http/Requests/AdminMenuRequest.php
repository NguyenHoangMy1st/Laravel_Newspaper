<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminMenuRequest extends FormRequest
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
            'm_name'        => 'required',
            'm_description' => 'required',
            'm_slug'        => 'required|unique:menus,m_slug,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'm_name.required'        => 'Dữ liệu không được để trống',
            'm_slug.required'        => 'Dữ liệu không được để trống',
            'm_description.required' => 'Dữ liệu không được để trống',
            'm_slug.unique'          => 'Slug đã tồn tại',
        ];
    }
}
