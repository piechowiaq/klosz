<?php

declare(strict_types=1);

namespace App\Domains\User\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

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
     * @return array|string[]
     * @throws Exception
     */
    public function rules(): array
    {
        if (! assert($this->route('permissions.edit') instanceof Permission)) {
            throw new Exception('Received permission is not the required object');
        }
        dd($this->route('permissions.edit')->get('id'));
        return [
            'name' => ['required', Rule::unique('permissions', 'name')->ignore($this->route('permissions.edit')->get('id'))],
            'permissionIds' => 'required|array',
            'permissionIds.*' => 'exists:permissions,id',
        ];
    }
}
