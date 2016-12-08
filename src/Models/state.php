<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    public function Contacts()
    {
    	return $this->hasMany("Digi\Models\contact");
    }

    public function Agents()
    {
    	return $this->belongsToMany("Digi\Models\agent");
    }

    public function Zipcodes()
    {
    	return $this->hasMany("Digi\Models\zipcode", "state");
    }
}
