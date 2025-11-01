<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibInventoryCatItem extends Model
{
    use BaseTrait;
    protected $table = "lib_inventory_cat_items";
    protected $fillable = [
        'lib_inventory_cat_id',
        'name',
        'tag_name',
        'model',
        'description',
        'serial'
    ];
    //vpx_attach

    public function assigned()
    {
        return $this->hasOne(AdminUser::class,'id','admin_user_id');
    }
}
