<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TcPartage extends Model
{
    
    public function compte(){
        return $this->belongsTo('App\Compte');
    }

}
