<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class vehicle_assignment extends Model
{
	public function Lead()
	{
		return $this->belongsTo('Digi\Models\lead');
	}
	public function Vehicle()
	{
		return $this->hasOne('Digi\Models\\new_vehicle');
	}
	public function Driver()
	{
		return $this->hasOne('Digi\Models\\new_driver');
	}
}
?>