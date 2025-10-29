<?php

namespace App\Traits\PxTraits\Policies;

use App\Traits\PxTraits\Policies\Items\AttendancePolicyTrait;
use App\Traits\PxTraits\Policies\Items\DataLibratyTrait;
use App\Traits\PxTraits\Policies\Items\EmployeePolicyTrait;
use App\Traits\PxTraits\Policies\Items\SytemUserPolicyTrait;

trait BasePolicyTrait {

    use SytemUserPolicyTrait,DataLibratyTrait,EmployeePolicyTrait,AttendancePolicyTrait;
    public function systemPolicies(){
        return [
            [
                'name' => 'Admin Panel',
                'policies' => [
                    [
                        ...$this->employeePolicy()
                    ],
                    [
                        ...$this->attendancePolicy()
                    ],
                    [
                        ...$this->dataLibraryPolicy()
                    ],
                    [
                        ...$this->systemUserPolicies()
                    ]
                ]
            ]
        ];
    }
}
