<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TcCompte extends Model
{
    protected $fillable = ['user_id', 'name', 'members'];

    public function partages()
    {
        return $this->hasMany('App\TcPartage');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
