<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class lead_request extends Model
{
	public function Drivers(){
		return $this->hasMany("Digi\Models\driver", "lead_id");
	}
	public function Agent(){
		return $this->belongsTo("Digi\Models\agent");
	}
	public function Lead(){
		return $this->belongsTo("Digi\Models\lead");
	}
	public function Vehicles(){
		return $this->hasMany("Digi\Models\\vehicle", "lead_id");
	}
	public function Tickets(){
		return $this->hasMany("Digi\Models\\ticket", "lead_id");
	}
	public function Claims(){
		return $this->hasMany("Digi\Models\claim", "lead_id");
	}
	public function Major_Violations(){
		return $this->hasMany("Digi\Models\major_violation", "lead_id");
	}
}
?>