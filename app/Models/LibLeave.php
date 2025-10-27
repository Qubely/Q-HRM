<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibLeave extends Model
{
    use BaseTrait;
    protected $table = "lib_leaves";
    protected $fillable = [
        'name',
        'count'
    ];
    //vpx_attach
}
