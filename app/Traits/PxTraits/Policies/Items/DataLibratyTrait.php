<?php

namespace App\Traits\PxTraits\Policies\Items;

trait DataLibratyTrait {

    public function dataLibraryPolicy(){
        return [
            'name' => 'Data Library Policy',
            'policies' => [
                [
                    'name' => 'Lib Department Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                [
                    'name' => 'Lib Designation Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                  [
                    'name' => 'Lib Leave Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                [
                    'name' => 'Lib Board Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                [
                    'name' => 'Lib Dgree Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                [
                    'name' => 'Lib Salary Head Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                 [
                    'name' => 'Lib Salary Group Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
                [
                    'name' => 'Lib Bank Crud',
                    'keys' => ['view','store','bulk_update','delete','pdf','excel','edit']
                ],
            ]
        ];
    }
}
