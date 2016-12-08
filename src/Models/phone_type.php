<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class phone_type extends Model
{
    public function Contacts()
    {
    	return $this->hasMany("Digi\Models\contact", "phone_number_type");
    }
}
