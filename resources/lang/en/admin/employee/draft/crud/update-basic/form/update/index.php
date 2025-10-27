<?php
return [
    'pageTitle' => '',
    'pageSubTitle' => '',
    'add' => '',
    'update' => '',
    'breadCum' => [
        'title' => 'Update Employee ',
        'b1' => 'Employee',
        'b2' => 'Manage',
        'b3' => 'Update'
    ],
    'nav' => [
        ...require resource_path('lang/en/admin/employee/draft/crud/nav/index.php')
    ],
    'fields' => [
        'father_name' => 'Father Name',
        'mother_name' => 'Mother Name',
        'present_address' => 'Present Adress',
        'permanent_address' => 'Permanant Address',
        'gender' => 'Gender',
        'date_of_birth' => 'Date of Birth',
        'nid' => "National ID",
        'emergency_contact' => 'Emergency Contact',
        'maritual_status' => 'Maritual Status',
    ],
    'table' => [
        'id' => 'ID',
        'name' => 'Name',
        'created' => 'Created',
        'actions' => 'Actions',
    ]
];
