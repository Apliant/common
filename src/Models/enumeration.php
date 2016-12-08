<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class enumeration extends Model
{
	public function Enumeration_Type(){
		return $this->hasOne("Digi\Models\enumeration_type", "type_id");
	}
}
?>