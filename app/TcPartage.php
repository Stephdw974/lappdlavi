<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TcPartage extends Model
{

    protected $fillable = ['tc_comptes_id', 'name', 'amount', 'payedBy', 'payedFor'];

    public function compte()
    {
        return $this->belongsTo('App\TcCompte');
    }
}
