<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
	public function Agency()
	{
		return $this->belongsTo('Digi\Models\agency');
	}
	public function Invoice()
	{
		return $this->belongsTo('Digi\Models\invoice');
	}
}
?>