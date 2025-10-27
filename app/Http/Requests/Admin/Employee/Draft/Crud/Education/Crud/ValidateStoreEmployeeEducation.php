<?php

namespace App\Http\Requests\Admin\Employee\Draft\Crud\Education\Crud;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
class ValidateStoreEmployeeEducation extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'dgree_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('employee_educations')->where(function ($query) use ($request) {
                    return $query->where('employee_id', $request->employee_id)->where('dgree_name',$request->dgree_name);
                }),
            ],
            'board' => 'required|string|max:100',
            'passing_year' => 'required|digits:4',
            'result' => 'required|string|max:50',
        ];
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
