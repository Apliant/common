<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
	public function Lead(){
		return $this->belongsTo("Digi\Models\lead_request", "lead_id");
	}
	public function Accidents(){
		return $this->hasMany("Digi\Models\accident");
	}
	public function Tickets(){
		return $this->hasMany("Digi\Models\\ticket");
	}
	public function Claims(){
		return $this->hasMany("Digi\Models\claim");
	}
	public function Major_Violations(){
		return $this->hasMany("Digi\Models\major_violation");
	}
}
?>