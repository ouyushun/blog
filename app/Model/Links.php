<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    public $table = 'links';
    public $primaryKey = 'link_id';
    public $timestamps = false;
    public $guarded = ['link_id'];

}
