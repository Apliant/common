<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class market extends Model
{
    public function Agencies()
    {
    	return $this->belongsToMany("Digi\Models\agency", "agency_markets");
    }

    public function MarketType()
    {
    	return $this->hasOne("Digi\Models\market_type");
    }
}
