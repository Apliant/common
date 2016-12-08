<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class recent_contact extends Model
{
	public function Agent(){
		return $this->hasOne("Digi\Models\agent");
	}

	public function RecentMessages(){
		return $this->hasMany("Digi\Models\\recent_message");
	}
}
?>