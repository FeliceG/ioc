<?php

namespace ioc;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{

	public function user() {
		return $this->belongsTo('\ioc\User');
	}

}
