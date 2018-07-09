<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseProposal extends Model
{
    protected $table = 'tb_purchase_proposal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_source', 'qty', 'id_measurement', 'status', 'created_at', 'updated_at'
    ];

    public function source(){
        return $this->belongsTo('App\Sourcing', 'id_source');
    }
}
