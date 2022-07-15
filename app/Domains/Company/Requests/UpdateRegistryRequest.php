<?php

namespace App\Domains\Company\Requests;

use App\Domains\Company\Models\Company;
use App\Domains\Company\Models\Registry;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRegistryRequest extends FormRequest
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
        if (! assert($this->route('registry') instanceof Registry)) {
            throw new Exception('Received registry is not the required object');
        }
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'valid_for' => ['required','int'],
        ];
    }
}
