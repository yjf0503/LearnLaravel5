<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    public function hasManyComments(){
    	return $this->hasMany('App\Comment', 'paper_id', 'id');
    }
}
