<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TcCompte extends Model
{
    
    public function partages() {
        return $this->hasMany('App\Partage');
    }

}
