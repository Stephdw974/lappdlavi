<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['user_id', 'backgroundImage', 'mainColor', 'pinCode'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
