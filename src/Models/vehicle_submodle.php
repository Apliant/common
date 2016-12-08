<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class vehicle_submodel extends Model
{
	public function Model()
	{
		return $this->belongsTo("Digi\Models\\vehicle_model");
	}
}
