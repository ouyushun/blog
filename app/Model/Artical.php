<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
    public $table = 'artical';
    public $primaryKey = 'art_id';
    public $timestamps = false;
    public $guarded = ['art_id'];
    

}
