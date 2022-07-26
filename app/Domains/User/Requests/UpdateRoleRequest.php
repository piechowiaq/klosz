<?php

declare(strict_types=1);

namespace App\Domains\User\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UpdateRoleRequest extends FormRequest
{
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

        if (! assert($this->route('role') instanceof Role)) {
            throw new Exception('Received role is not the required object');
        }

        return [
            'name' => [
                'required', 'max:255',
                Rule::unique('roles')->ignore($this->route('role')->id),
            ],
            'permission_ids' => ['required','array'],
            'permission_ids.*' => ['exists:permissions,id'],
        ];
    }
}
