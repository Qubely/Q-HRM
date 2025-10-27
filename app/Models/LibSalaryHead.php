<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibSalaryHead extends Model
{
    use BaseTrait;
    protected $table = "lib_salary_heads";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach
}
