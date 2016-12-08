<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class major_violation extends Model
{
	public function Lead(){
		return $this->belongsTo("Digi\Models\lead_request", 'lead_id');
	}
	public function Driver(){
		return $this->belongsTo("Digi\Models\driver");
	}
}
?>