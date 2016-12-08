<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier_commission extends Model
{
    protected $table = "carrier_commissions_new";

    public function Agency()
    {
    	return $this->belongsTo('Digi\Models\agency');
    }
    public function Carrier()
    {
    	return $this->hasOne('Digi\Models\carrier');
    }
    public function State()
    {
        return $this->hasOne("Digi\Models\state");
    }
    public function LOB()
    {
        return $this->hasOne("Digi\Models\enumeration", "id", 'lob');
    }
    public function Tier()
    {
        return $this->hasOne("Digi\Models\enumeration", 'id', 'tier');
    }
}