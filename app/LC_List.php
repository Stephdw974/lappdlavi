<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LC_List extends Model
{
    protected $fillable = ['user_id', 'name', 'is_private'];




    public function user()
    {
        return $this->belongsTo('App\User');
    }




    public function articles()
    {
        return $this->hasMany('App\LC_Article');
    }
}
