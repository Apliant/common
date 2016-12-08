<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class vehicle_make extends Model
{
	public function Models()
	{
		return $this->hasMany("Digi\Models\\vehicle_model");
	}
}
