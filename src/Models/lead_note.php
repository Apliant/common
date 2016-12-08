<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class lead_note extends Model
{
	public function Agent(){
		return $this->belongsTo("Digi\Models\agent");
	}
	public function Lead(){
		return $this->belongsTo("Digi\Models\lead");
	}
}
?>