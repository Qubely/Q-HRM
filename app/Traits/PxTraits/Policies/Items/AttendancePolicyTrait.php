<?php

namespace App\Traits\PxTraits\Policies\Items;

trait AttendancePolicyTrait {

    public function attendancePolicy(){
        return [
            'name' => 'Attendance Policy',
            'policies' => [
                [
                    'name' => 'Month Wise Load View',
                    'keys' => ['view','load']
                ],
                [
                    'name' => 'Employee Recon Dt',
                    'keys' => ['view','load']
                ],
            ]
        ];
    }
}
