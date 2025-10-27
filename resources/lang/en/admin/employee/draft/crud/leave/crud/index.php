<?php
return [
    'pageTitle' => '',
    'pageSubTitle' => '',
    'add' => 'Add New Leave',
    'update' => 'Update Leave',
    'breadCum' => [
        'title' => 'Employee Leave',
        'b1' => 'Employee',
        'b2' => 'Manage',
        'b3' => 'Leave'
    ],
    'nav' => [
        ...require resource_path('lang/en/admin/employee/draft/crud/nav/index.php')
    ],
    'fields' => [
        'serial' => 'Serial',
        'lib_leave_id' => 'Leave Type',
        'count' => 'Total Leave',
    ],
    'table' => [
        'id' => 'ID',
        'serial' => 'Serial',
        'lib_leave_id' => 'Leave Type',
        'count' => 'Total Leave',
        'created' => 'Created',
        'actions' => 'Actions',
    ]
];
