<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function customers()
     {
        return $this->belongsToMany('App\Customer');
     }

	public function getRouteByName()
	{
		return 'name';
	}
}
