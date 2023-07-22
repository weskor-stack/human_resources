<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'employee_id' => 'required',
            'position_id' => 'required',
            'type_contract_id' => 'required',
            'start_date' => 'required',
            'check_attendance' => 'required',
            'status_contract_id' => 'required',
        ];
    }
}
