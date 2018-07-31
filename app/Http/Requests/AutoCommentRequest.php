<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoCommentRequest extends FormRequest
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
            'fbid' => 'required|numeric',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fbid.required' => 'Bạn không được để trống ID',
            'fbid.numeric' => 'Bạn nhập ID sai định dạng',
            'message.required' => 'Bạn chưa nhập nội dung commment',
        ];
    }
}
