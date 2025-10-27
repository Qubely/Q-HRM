<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibDesignation extends Model
{
    use BaseTrait;
    protected $table = "lib_designations";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach
}
