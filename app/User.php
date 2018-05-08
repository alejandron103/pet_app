<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    use Notifiable, Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'age', 'email', 'gender', 'description', 'photo', 'breed_id', 'password'   
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function getPhotoAttribute($value){
        if ($value) {
            return url("local/".$value);
        }else{
            return 'https://www.fancyhands.com/images/default-avatar-250x250.png';
        }
    }

    public function breed(){
        return $this->belongsTo('App\Breed');
    }
    /*public function setNameAttribute($value){
        $this->attributes['name']= ucfirst($value);
    }*/
}