<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class lead_state extends Model
{
	public function Lead()
	{
		return $this->belongsTo("Digi\Models\lead");
	}

}
