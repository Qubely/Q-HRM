<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibDgree extends Model
{
    use BaseTrait;
    protected $table = "lib_dgrees";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach
}
