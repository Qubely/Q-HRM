<?php

namespace App\Http\Requests\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
class ValidateEmployeeUpdate extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function message() : array
    {
        return [
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules($request,$row): array
    {
        $rules =  [
            'father_name'        => 'nullable|string|max:100',
            'mother_name'        => 'nullable|string|max:100',
            'present_address'    => 'nullable|string|max:255',
            'permanent_address'  => 'nullable|string|max:255',
            'gender'             => 'nullable|in:Male,Female,Other',
            'date_of_birth'      => 'nullable|date|before:today',
            'nid'                => 'nullable|string|max:30',
            'emergency_contact'  => 'nullable|string|max:20',
            'maritual_status'    => 'nullable|in:Single,Married,Divorced,Widowed',
        ];
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ]);
        throw (new ValidationException($validator, $response))->errorBag($this->errorBag);
    }
}
