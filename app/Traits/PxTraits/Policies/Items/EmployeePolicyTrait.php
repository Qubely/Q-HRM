<?php

namespace App\Traits\PxTraits\Policies\Items;

trait EmployeePolicyTrait {

    public function employeePolicy(){
        return [
            'name' => 'Employee Trait',
            'policies' => [
                [
                    'name' => 'Employee Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit','employee_view','employee_edit']
                ],
                [
                    'name' => 'Employee Form Update',
                    'keys' => ['view','update']
                ],
                [
                    'name' => 'Employee Education Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                [
                    'name' => 'Employee Bank Details Update',
                    'keys' => ['view','update']
                ],
                [
                    'name' => 'Employee Leave Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                [
                    'name' => 'Employee Salary Salary Setup Update',
                    'keys' => ['view','update']
                ],
                [
                    'name' => 'Employee Detail Modal',
                    'keys' => ['view','view_detail','print_detail','view_appointment','pdf_appointment','view_confirm','pdf_confrim']
                ],
                [
                    'name' => 'Active Employee Dt',
                    'keys' => ['view']
                ],
            ]
        ];
    }
}
