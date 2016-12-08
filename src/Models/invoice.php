<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
	public function Items()
	{
		return $this->hasMany('Digi\Models\invoice_item');
	}
	public function Agency()
	{
		return $this->belongsTo('Digi\Models\agency');
	}
	public function Author()
	{
		return $this->belongsTo('Digi\Models\agent', 'id', 'created_by');
	}
}
?>