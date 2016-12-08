<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class quote_execution_detail extends Model
{
	public function Batch()
	{
		return $this->belongsTo('Digi\Models\quote_batch', 'QuoteExecutionID', 'QuoteExecutionID');
	}
	
}
?>