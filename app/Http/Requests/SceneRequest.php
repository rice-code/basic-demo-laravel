<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Rice\Basic\Support\Traits\Scene;

class SceneRequest extends FormRequest
{
    use Scene;
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
            'state' => 'required|max:1',
            'auth_code' => 'required|max:2'
        ];
    }

    public function scenes()
    {
        return [
            'callback' => []
        ];
    }
}
