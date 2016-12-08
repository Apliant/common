<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class campaign extends Model
{
    

    public function Leads()
    {
    	return $this->hasMany("Digi\Models\lead", "campaign", "campaign_id");
    }
    public function Author(){
    	return $this->hasOne("Digi\Models\agent", "id", "author");
    }
    public function Source(){
    	return $this->hasOne("Digi\Models\vendor", 'id', "source");
    }
    public function Tier(){
    	return $this->hasOne('Digi\Models\enumeration', 'id', 'tier');
    }
  
}
