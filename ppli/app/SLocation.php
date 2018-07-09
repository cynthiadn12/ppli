<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SLocation extends Model
{
    protected $table = 'tb_loc_lvl2';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_loc_lvl1', 'loc_name', 'created_at', 'updated_at'
    ];
}
