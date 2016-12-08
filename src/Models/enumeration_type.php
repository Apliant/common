<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class enumeration_type extends Model
{
	public function Enumerations(){
		return $this->hasMany("Digi\Models\\enumeration", 'type_id');
	}
}
?>