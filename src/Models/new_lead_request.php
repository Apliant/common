<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class new_lead_request extends Model
{
	protected $table = "lead_requests_new";

	public function Lead(){
		return $this->belongsTo("Digi\Models\lead");
	}
	public function PriorCarrier(){
		return $this->hasOne("Digi\Models\enumeration", "id", "PriorCarrier");
	}
	public function PD(){
		return $this->hasOne("Digi\Models\enumeration", "id", "PD");
	}
	public function MP(){
		return $this->hasOne("Digi\Models\enumeration", "id", "MP");
	}
	public function UM(){
		return $this->hasOne("Digi\Models\enumeration", "id", "UM");
	}
	public function UIM(){
		return $this->hasOne("Digi\Models\enumeration", "id", "UIM");
	}
	public function CurrentOwnership(){
		return $this->hasOne("Digi\Models\enumeration", "id", "CurrentOwnership");
	}
	public function PriorLiabilityLimit(){
		return $this->hasOne("Digi\Models\enumeration", "id", "PriorLiabilityLimit");
	}
	public function ReasonForLapse(){
		return $this->hasOne("Digi\Models\enumeration", "id", "ReasonForLapse");
	}
	public function PriorPolicyTerm(){
		return $this->hasOne("Digi\Models\enumeration", "id", "PriorPolicyTerm");
	}
	public function PolicyTerm(){
		return $this->hasOne("Digi\Models\enumeration", "id", "PolicyTerm");
	}
	public function BI(){
		return $this->hasOne("Digi\Models\enumeration", "id", "BI");
	}
	public function State(){
		return $this->hasOne("Digi\Models\state", "id", "StateCode");
	}
}