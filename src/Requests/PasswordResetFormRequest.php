<?php

namespace peczis\pecCms\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetFormRequest extends FormRequest
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
            'email' => 'required|exists:'. PEC_CMS_PREFIX . 'users,email'
        ];
    }
}
