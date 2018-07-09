<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sourcing extends Model
{
    protected $table = 'tb_source';

    protected $fillable = [
    	'id', 'id_loc_lvl1','id_loc_lvl2','id_vendor','id_fish','qty','id_measurement','price','valid_until'
    ];

    public function purchase(){
        return $this->hasMany('App\PurchaseProposal');
    }
}
