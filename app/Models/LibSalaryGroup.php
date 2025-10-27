<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibSalaryGroup extends Model
{
    use BaseTrait;
    protected $table = "lib_salary_groups";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach

    public function salaryItems()
    {
        return $this->hasMany(LibSalaryGroupItem::class,'lib_salary_group_id','id');
    }
}
