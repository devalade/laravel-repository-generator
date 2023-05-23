<?php

namespace App\Sample\Test\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class TestFormRequest extends FormRequest
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
}
