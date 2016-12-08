<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class accident extends Model
{
	public function Lead(){
		return $this->belongsTo("Digi\Models\\new_lead_request", 'lead_id');
	}
	public function Driver(){
		return $this->belongsTo("Digi\Models\\new_driver");
	}
	public function Description(){
		return $this->hasOne("Digi\Models\enumeration");
	}
}
?>