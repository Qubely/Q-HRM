<?php

namespace App\Http\Requests\Admin\Employee\Draft\Crud\Leave\Crud;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
class ValidateStoreEmployeeLeave extends FormRequest
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
            'lib_leave_id' => [
                'required',
                'exists:lib_leaves,id',
                Rule::unique('employee_leaves')->where(function ($query) use ($request) {
                    return $query->where('employee_id', $request->employee_id)->where('lib_leave_id',$request->lib_leave_id);
                }),
            ],
            'count' => 'required|numeric|min:1',
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
