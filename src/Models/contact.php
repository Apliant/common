<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{

    protected $fillable = array('agent_id', 'contact_type');

    public function Agency()
    {
    	return $this->belongsTo("Digi\Models\agency");
    }

    public function Agent()
    {
    	return $this->belongsTo("Digi\Models\agent");
    }

    public function ContactType()
    {
    	return $this->belongsTo("Digi\Models\contact_type", "id", "contact_type");
    }

    public function State()
    {
    	return $this->belongsTo("Digi\Models\state");
    }

    public function Country()
    {
    	return $this->belongsTo("Digi\Models\country", "id", "country");
    }
}
