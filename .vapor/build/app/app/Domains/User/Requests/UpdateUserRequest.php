<?php

declare(strict_types=1);

namespace App\Domains\User\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use App\Domains\User\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class UpdateUserRequest extends FormRequest
{
    use PasswordValidationRules;
    /**
     * Determine if the user is authorized to make this request.
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
    public function rules(): array
    {

        if (! assert($this->route('user') instanceof User)) {
            throw new Exception('Received user is not the required object');
        }
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => $this->passwordRules(),
            'email' => ['required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($this->route('user')->id)],
            'phone' => ['required', 'string', 'max:255'],
            'company_ids' => ['required', 'array', Rule::requiredIf(! $this->route('user')->hasRole('Super Admin'))],
            'company_ids.*' => ['exists:companies,id'],
        ];
    }
}
