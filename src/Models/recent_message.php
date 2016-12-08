<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class recent_message extends Model
{
	public function RecentContact(){
		return $this->hasOne("Digi\Models\\recent_contact");
	}
}
?>