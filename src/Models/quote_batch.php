<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class quote_batch extends Model
{
	public function Carrier()
	{
		return $this->belongsTo('Digi\Models\carrier', 'ezlynx_id', 'CarrierID');
	}
	public function Lead()
	{
		return $this->belongsTo('Digi\Models\lead');
	}
	public function Details()
	{
		return $this->hasMany('Digi\Models\quote_execution_detail', 'QuoteExecutionID', 'QuoteExecutionID');
	}
}
?>