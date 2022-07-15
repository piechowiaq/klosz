<?php

namespace App\Domains\Company\Requests;

use App\Domains\Company\Models\Company;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
            'report_date' => ['required', 'date'],

            'notes' => ['string', 'max:255'],
            'company_id' => ['required','exists:companies,id'],
            'registry_id' => ['required', 'exists:registries,id'],
        ];
    }
}
