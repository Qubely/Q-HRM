<?php
return [
    'pageTitle' => '',
    'pageSubTitle' => '',
    'add' => 'Add New Salary Setup',
    'update' => 'Update Salary Setup',
    'breadCum' => [
        'title' => 'Employee Salary Setup',
        'b1' => 'Employee',
        'b2' => 'Manage',
        'b3' => 'Salary Setup'
    ],
    'nav' => [
        ...require resource_path('lang/en/admin/employee/draft/crud/nav/index.php')
    ],
    'fields' => [
        'lib_salary_group_id' => 'Salary Group',
    ],
    'table' => [
    ]
];
