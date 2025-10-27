<?php
return [
    'pageTitle' => '',
    'pageSubTitle' => '',
    'add' => 'Add New Education',
    'update' => 'Update Education',
    'breadCum' => [
        'title' => 'Employee Education',
        'b1' => 'Employee',
        'b2' => 'Manage',
        'b3' => 'Education'
    ],
    'nav' => [
        ...require resource_path('lang/en/admin/employee/draft/crud/nav/index.php')
    ],
    'fields' => [
        'serial' => 'Serial',
        'dgree_name' => 'Dgree Name',
        'board' => 'Education Board',
        'passing_year' => 'Passing Year',
        'result' => 'Gpa/CGPA/Result',
    ],
    'table' => [
        'id' => 'ID',
        'serial' => 'Serial',
        'dgree_name' => 'Dgree Name',
        'board' => 'Education Board',
        'passing_year' => 'Passing Year',
        'result' => 'Gpa/CGPA/Result',
        'created' => 'Created',
        'actions' => 'Actions',
    ]
];
