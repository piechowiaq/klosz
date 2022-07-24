<?php

namespace App\Domains\Company\Requests;

use App\Domains\Company\Models\Company;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
     * @return array|string[]
     * @throws Exception
     */
    public function rules(): array
    {
        if (! assert($this->route('company') instanceof Company)) {
            throw new Exception('Received company is not the required object');
        }

        return [
            'name' => ['required', 'string' , 'max:255'],
            'city' => ['required', 'string' , 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
                Rule::unique('companies')->ignore($this->route('company')->id)],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}
