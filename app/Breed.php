<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    //
    protected $fillable=[
    	'name', 'type_id'
    ];

    public function type(){
        return $this->belongsTo('App\Type');
    }
}
