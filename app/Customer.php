<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   protected $table = 'customers';

    public function notes()
    {
       return $this->hasMany('App\Note');
    }

    public function categories()
    {
       return $this->belongsToMany('App\Category');
    }

	 public function user()
    {
        return $this->belongsTo('App\User');
    }


}
