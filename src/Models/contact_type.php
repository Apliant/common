<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class contact_type extends Model
{
    public function Contacts()
    {
    	return $this->hasMany("Digi\Models\contact", "contact_type");
    }
}
