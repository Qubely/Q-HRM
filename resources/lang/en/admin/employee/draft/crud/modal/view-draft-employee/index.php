<?php
return [
    'pageTitle' => '',
    'pageSubTitle' => '',
    'add' => '',
    'update' => '',
    'breadCum' => [
        'title' => '',
        'b1' => '',
        'b2' => '',
        'b3' => ''
    ],
    'nav' => [
        'item1' => ' crud'
    ],
    'tabs' => [
        'details' => [
            'tab' => 'Employee Details',
            'sections' => [
                'personal' => [
                    'name'=> 'Personal Info',
                    'fileds' => [
                        'image' => 'Employee Photo',
                        'name' => 'Name',
                        'email' => 'Email',
                        'lib_department_id' => 'Department',
                        'lib_designation_id' => 'Designation',
                        'mobile_number' => 'Mobile Number',
                        'avatar' => 'Employee Avatar',
                        'user_access' => 'Employee Access',
                        'status' => 'Status',
                        'father_name' => 'Father Name',
                        'mother_name' => 'Mother Name',
                        'present_address' => 'Present Adress',
                        'permanent_address' => 'Permanant Address',
                        'gender' => 'Gender',
                        'date_of_birth' => 'Date of Birth',
                        'nid' => "National ID",
                        'emergency_contact' => 'Emergency Contact',
                        'maritual_status' => 'Maritual Status',
                    ]
                ],
                'leave' => [
                    'name' => 'Assigned Leave',
                    'fileds' => [
                        'serial' => 'Serial',
                        'lib_leave_id' => 'Leave Type',
                        'count' => 'Total Leave',
                        'spent' => 'Total Spent',
                    ]
                ],
                'education' => [
                    'name' => 'Education',
                    'fileds' => [
                        'serial' => 'Serial',
                        'dgree_name' => 'Dgree Name',
                        'board' => 'Education Board',
                        'passing_year' => 'Passing Year',
                        'result' => 'Gpa/CGPA/Result',
                    ]
                ],
                'bank' => [
                    'name' => 'Bank Details',
                    'fileds' => [
                        'bank_name' => 'Bank Name',
                        'branch' => 'Branch',
                        'ac_name' => 'Account Name',
                        'ac_number' => 'Account Number',
                    ]
                ],
                'salary' => [
                    'name' => 'Salary Structure',
                    'fileds' => [
                        'serial' => 'Serial',
                        'type' => 'Type',
                        'decription' => 'Description',
                        'amount' => 'Amount',
                        'total_amount' => 'Total Amount',
                    ]
                ],
            ]
        ],
        'confirm' => [
            'tab' => 'Confirm Applicant',
            'fileds' => [
                'employee_id'=> 'Employee ID',
                'joining_date' => 'Joining Date'
            ],
            'btn' => [
                'employee_entry' => 'Entry Employee'
            ]
        ]
    ],
    'fields' => [
        'name' => 'Name',
    ],
    'table' => [
        'id' => 'ID',
        'name' => 'Name',
        'created' => 'Created',
        'actions' => 'Actions',
    ]
];
