<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class vehicle_model extends Model
{
	public function Submodels()
	{
		return $this->hasMany("Digi\Models\\vehicle_submodel");
	}

	public function Make()
	{
		return $this->belongsTo("Digi\Models\\vehicle_make");
	}

	public function Years()
	{
		return $this->belongsToMany("Digi\Models\\vehicle_year");
	}
}
