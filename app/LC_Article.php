<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LC_Article extends Model
{
    protected $fillable = ['l_c__list_id', 'name', 'is_buyed'];




    public function liste()
    {
        return $this->belongsTo('App\LC_Liste');
    }
}
