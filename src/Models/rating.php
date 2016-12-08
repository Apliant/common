<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
	public function Agent()
	{
		return $this->belongsTo("Digi\Models\agent");
	}

}
