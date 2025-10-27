<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class EmployeeEducation extends Model
{
    use BaseTrait;
    protected $table = "employee_educations";
    protected $fillable = [
        'serial',
        'employee_id',
        'dgree_name',
        'board',
        'passing_year',
        'result'
    ];
    //vpx_attach
}
