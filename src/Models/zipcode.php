<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class zipcode extends Model
{
	protected $table = "zipcode_lookup";
	public function State()
	{
		return $this->belongsTo("Digi\Models\state", "state");
	}
}
