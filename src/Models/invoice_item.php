<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class invoice_item extends Model
{
	public function Invoice()
	{
		return $this->belongsTo('Digi\Models\invoice');
	}
}
?>