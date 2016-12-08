<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class squish_vin extends Model
{
	public function Year()
	{
		return $this->hasOne('Digi\Models\vehicle_year', 'year', 'year');
	}
	public function Make()
	{
		return $this->hasOne('Digi\Models\vehicle_make', 'make', 'make');
	}
	public function Model()
	{
		return $this->hasOne('Digi\Models\vehicle_model', 'model', 'model');
	}
	public function Submodel()
	{
		return $this->hasOne('Digi\Models\vehicle_submodel', 'submodel', 'submodel');
	}
}
