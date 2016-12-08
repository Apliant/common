<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class lead_call extends Model{
	
	protected $table = "lead_call";
	public function Agent(){
		return $this->belongsTo('Digi\Models\agent');
	}
}