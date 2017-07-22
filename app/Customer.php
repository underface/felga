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
}
