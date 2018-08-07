<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public $table = 'roles';

    protected $fillable = ['id','rol'];

    	
    /*public function user (){
    	return $this->belongsTo('App\User');
    }*/

}
