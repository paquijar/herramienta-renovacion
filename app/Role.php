<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	//RElaciones muchos a muchos con users
	public function users() {
		return $this
			->belongsToMany('App\User')
			->withTimestamps();
	}
}
