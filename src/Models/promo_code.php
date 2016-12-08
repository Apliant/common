<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class promo_code extends Model
{
	public function Agents()
	{
		return $this->hasMany('Digi\Models\agent', 'promo_code', 'id');
	}
}
?>