<?php
return [
    'pageTitle' => '',
    'pageSubTitle' => '',
    'add' => 'Add New Bank Details',
    'update' => 'Update Bank Details',
    'breadCum' => [
        'title' => 'Employee Bank Details',
        'b1' => 'Employee',
        'b2' => 'Manage',
        'b3' => 'Bank Details'
    ],
    'nav' => [
        ...require resource_path('lang/en/admin/employee/draft/crud/nav/index.php')
    ],
    'fields' => [
        'bank_name' => 'Bank Name',
        'branch' => 'Branch',
        'ac_name' => 'Account Name',
        'ac_number' => 'Account Number',
    ],
    'table' => [
        'id' => 'ID',
        'bank_name' => 'Bank Name',
        'branch' => 'Branch',
        'ac_name' => 'Account Name',
        'ac_number' => 'Account Number',
        'created' => 'Created',
        'actions' => 'Actions',
    ]
];
