<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibInventoryCat extends Model
{
    use BaseTrait;
    protected $table = "lib_inventory_cats";
    protected $fillable = [
        'name',
        'serial'
    ];
    //vpx_attach

    public function totalItems()
    {
        return $this->hasMany(LibInventoryCatItem::class,'lib_inventory_cat_id','id');
    }
}
