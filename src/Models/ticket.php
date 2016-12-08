<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
	public function Lead(){
		return $this->belongsTo("Digi\Models\\new_lead_request", 'lead_id');
	}
	public function Driver(){
		return $this->belongsTo("Digi\Models\\new_driver");
	}
}
?>