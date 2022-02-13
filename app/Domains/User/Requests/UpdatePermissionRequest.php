<?php

declare(strict_types=1);

namespace App\Domains\User\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class UpdatePermissionRequest extends FormRequest
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
        if (! assert($this->route('permission') instanceof Permission)) {
            throw new Exception('Received permission is not the required object');
        }

        return [
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('permissions')->ignore($this->route('permission')->id),
            ],
        ];
    }
}
