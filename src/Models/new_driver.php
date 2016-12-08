<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class new_driver extends Model
{
	protected $table = "drivers_new";
	public function DLState(){
		return $this->hasOne('Digi\Models\enumeration', "id", "DLState");
	}
	public function DLStatus(){
		return $this->hasOne('Digi\Models\enumeration', "id", "DLStatus");
	}
	public function Gender(){
		return $this->hasOne('Digi\Models\enumeration', "id", "Gender");
	}
	public function LeadRequest(){
		return $this->belongsTo("Digi\Models\\new_lead_request", "lead_id", "lead_id");
	}
	public function MaritalStatus(){
		return $this->hasOne("Digi\Models\enumeration", "id", "MaritalStatus");
	}
	public function PrincipalVehicle(){
		return $this->hasOne("Digi\Models\\new_vehicle", "id", "PrincipalVehicle");
	}
	public function Relation(){
		return $this->hasOne("Digi\Models\enumeration", "id", "Relation");
	}
	public function Vehicle(){
		return $this->hasOne("Digi\Models\\new_vehicle", "id", "vehicle_id");
	}
	public function Industry(){
		return $this->hasOne("Digi\Models\enumeration", "id", "Industry");
	}
	public function Occupation(){
		return $this->hasOne("Digi\Models\enumeration", "id", "Occupation");
	}
}