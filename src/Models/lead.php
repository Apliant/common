<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class lead extends Model
{
	public function Agent()
	{
		return $this->belongsTo("Digi\Models\agent");
	}

	public function LeadRequest()
	{
		return $this->hasOne("Digi\Models\\new_lead_request");
	}

	public function Callbacks()
	{
		return $this->hasMany("Digi\Models\callbacks");
	}
	public function Policy()
	{
		return $this->hasOne('Digi\Models\policy');
	}
	public function State(){
		return $this->hasOne("Digi\Models\enumeration", "id", "state");
	}
	public function Campaign(){
		return $this->hasOne('Digi\Models\campaign', 'campaign_id', 'campaign');
	}
	public function Vehicles(){
		return $this->hasMany('Digi\Models\\new_vehicle', 'lead_id', 'id');
	}
	public function Drivers(){
		return $this->hasMany('Digi\Models\\new_driver', 'lead_id', 'id');
	}
}
?>
