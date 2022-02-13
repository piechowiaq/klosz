<?php

namespace App\Domains\Company\Requests;

use App\Domains\Company\Models\Company;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws Exception
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255', 'unique:companies'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}
