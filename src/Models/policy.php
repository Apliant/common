<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class policy extends Model
{
	protected $table = 'policies';
	public function Carrier()
	{
		return $this->belongsTo('Digi\Models\carrier', 'id', 'carrier');
	}
	public function Lead()
	{
		return $this->belongsTo('Digi\Models\lead');
	}
	public function Agency()
	{
		return $this->belongsTo('Digi\Models\agency', 'id', 'CompanyCode');
	}
	public function Agent()
	{
		return $this->belongsTo('Digi\Models\agent', 'id', 'CsrCode');
	}

}
