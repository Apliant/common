<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier extends Model
{
    public function Agencies()
    {
    	return $this->belongsToMany("Digi\Models\agency", "agency_carriers");
    }

    public function Products()
    {
    	return $this->hasMany("Digi\Models\carrier_product");
    }

    public function Agents()
    {
    	return $this->belongsToMany("Digi\Models\agent");
    }
    public function CarrierState()
    {
        return $this->hasMany("Digi\Models\carrier_state");
    }
    public function Quotes()
    {
        return $this->hasMany("Digi\Models\quote_batch", "CarrierID", "ezlynx_id");
    }
    public function Policies()
    {
        return $this->hasMany("Digi\Models\policy", "carrier");
    }
    public function Commissions()
    {
        return $this->hasMany("Digi\Models\carrier_commission");
    }
    public function Logins()
    {
        return $this->hasMany("Digi\Models\carrier_login", 'ezlynx_id', 'ezlynx_id');
    }

}
