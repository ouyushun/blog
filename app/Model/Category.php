<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'category';
    public $primaryKey = 'cate_id';
    public $timestamps = false;
    public $guarded = [];
    
}
