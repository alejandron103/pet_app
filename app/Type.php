<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable=[
    	'name'
    ];

    public function breeds(){
    	return $this->hasMany('App\Breed');
    }

    public function users(){
    	return $this->hasMany('App\User');
    }
}