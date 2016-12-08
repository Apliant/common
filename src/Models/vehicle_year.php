<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class vehicle_year extends Model
{
	public function Models()
	{
		return $this->belongsToMany("Digi\Modles\\vehicle_model");
	}
}
