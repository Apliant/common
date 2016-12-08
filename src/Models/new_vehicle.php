<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class new_vehicle extends Model
{
	protected $table = "vehicles_new";
	public function Lead(){
		return $this->belongsTo("Digi\Models\\new_lead_request", 'lead_id');
	}
	public function Driver(){
		return $this->belongsTo("Digi\Models\\new_driver");
	}
	public function Ownership(){
		return $this->hasOne("Digi\Models\enumeration", "id", "Ownership");
	}
	public function Operator(){
		return $this->hasOne("Digi\Models\new_driver", "id", "PrincipalOperator");
	}
	public function FYear(){
		return $this->hasOne("Digi\Models\\vehicle_year", "id", "Year");
	}
	public function FMake(){
		return $this->hasOne("Digi\Models\\vehicle_make", "id", "Make");
	}
	public function FModel(){
		return $this->hasOne("Digi\Models\\vehicle_model", "id", "Model");
	}
	public function PassiveRestraints(){
		return $this->hasOne("Digi\Models\enumerations", "id", "PassiveRestraints");
	}
	public function AntiTheft(){
		return $this->hasOne("Digi\Models\enumerations", "id", "AntiTheft");
	}
	public function Performance(){
		return $this->hasOne("Digi\Models\enumerations", "id", "Performance");
	}
	public function OtherCollisionDeductible(){
		return $this->hasOne("Digi\Models\enumerations", "id", "OtherCollisionDeductible");
	}
	public function CollisionDeductible(){
		return $this->hasOne("Digi\Models\enumerations", "id", "CollisionDeductible");
	}
	public function TowingDeductible(){
		return $this->hasOne("Digi\Models\enumerations", "id", "TowingDeductible");
	}
	public function RentalDeductible(){
		return $this->hasOne("Digi\Models\enumerations", "id", "RentalDeductible");
	}
	
}